/**
 * Highcharts Drilldown plugin
 * 
 * Author: Torstein Honsi
 * Last revision: 2013-02-18
 * License: MIT License
 *
 * Demo: http://jsfiddle.net/highcharts/Vf3yT/
 */

/*global HighchartsAdapter*/
(function (H) {

	"use strict";

	var noop = function () {},
		defaultOptions = H.getOptions(),
		each = H.each,
		extend = H.extend,
		wrap = H.wrap,
		Chart = H.Chart,
		seriesTypes = H.seriesTypes,
		PieSeries = seriesTypes.pie,
		ColumnSeries = seriesTypes.column,
		fireEvent = HighchartsAdapter.fireEvent;

	// Utilities
	function tweenColors(startColor, endColor, pos) {
		var rgba = [
				Math.round(startColor[0] + (endColor[0] - startColor[0]) * pos),
				Math.round(startColor[1] + (endColor[1] - startColor[1]) * pos),
				Math.round(startColor[2] + (endColor[2] - startColor[2]) * pos),
				startColor[3] + (endColor[3] - startColor[3]) * pos
			];
		return 'rgba(' + rgba.join(',') + ')';
	}

	// Add language
	extend(defaultOptions.lang, {
		drillUpText: '◁ Back to {series.name}'
	});
	defaultOptions.drilldown = {
		activeAxisLabelStyle: {
			cursor: 'pointer',
			color: '#039',
			fontWeight: 'bold',
			textDecoration: 'underline'			
		},
		activeDataLabelStyle: {
			cursor: 'pointer',
			color: '#039',
			fontWeight: 'bold',
			textDecoration: 'underline'			
		},
		animation: {
			duration: 500
		},
		drillUpButton: {
			position: { 
				align: 'right',
				x: -10,
				y: 10
			}
			// relativeTo: 'plotBox'
			// theme
		}
	};	

	/**
	 * A general fadeIn method
	 */
	H.SVGRenderer.prototype.Element.prototype.fadeIn = function () {
		this
		.attr({
			opacity: 0.1,
			visibility: 'visible'
		})
		.animate({
			opacity: 1
		}, {
			duration: 250
		});
	};

	// Extend the Chart prototype
	Chart.prototype.drilldownLevels = [];

	Chart.prototype.addSeriesAsDrilldown = function (point, ddOptions) {
		var oldSeries = point.series,
			xAxis = oldSeries.xAxis,
			yAxis = oldSeries.yAxis,
			newSeries,
			color = point.color || oldSeries.color,
			pointIndex,
			level;
			
		ddOptions = extend({
			color: color
		}, ddOptions);
		pointIndex = HighchartsAdapter.inArray(this, oldSeries.points);
		level = {
			seriesOptions: oldSeries.userOptions,
			shapeArgs: point.shapeArgs,
			bBox: point.graphic.getBBox(),
			color: color,
			newSeries: ddOptions,
			pointOptions: oldSeries.options.data[pointIndex],
			pointIndex: pointIndex,
			oldExtremes: {
				xMin: xAxis && xAxis.userMin,
				xMax: xAxis && xAxis.userMax,
				yMin: yAxis && yAxis.userMin,
				yMax: yAxis && yAxis.userMax
			}
		};

		this.drilldownLevels.push(level);

		newSeries = this.addSeries(ddOptions, false);
		if (xAxis) {
			xAxis.oldPos = xAxis.pos;
			xAxis.userMin = xAxis.userMax = null;
			yAxis.userMin = yAxis.userMax = null;
		}

		// Run fancy cross-animation on supported and equal types
		if (oldSeries.type === newSeries.type) {
			newSeries.animate = newSeries.animateDrilldown || noop;
			newSeries.options.animation = true;
		}
		
		oldSeries.remove(false);
		
		this.redraw();
		this.showDrillUpButton();
	};

	Chart.prototype.getDrilldownBackText = function () {
		var lastLevel = this.drilldownLevels[this.drilldownLevels.length - 1];

		return this.options.lang.drillUpText.replace('{series.name}', lastLevel.seriesOptions.name);

	};

	Chart.prototype.showDrillUpButton = function () {
		var chart = this,
			backText = this.getDrilldownBackText(),
			buttonOptions = chart.options.drilldown.drillUpButton;
			

		if (!this.drillUpButton) {
			this.drillUpButton = this.renderer.button(
				backText,
				null,
				null,
				function () {
					chart.drillUp(); 
				}
			)
			.attr(extend({
				align: buttonOptions.position.align,
				zIndex: 9
			}, buttonOptions.theme))
			.add()
			.align(buttonOptions.position, false, buttonOptions.relativeTo || 'plotBox');
		} else {
			this.drillUpButton.attr({
				text: backText
			})
			.align();
		}
	};

	Chart.prototype.drillUp = function () {
		var chart = this,
			level = chart.drilldownLevels.pop(),
			oldSeries = chart.series[0],
			oldExtremes = level.oldExtremes,
			newSeries = chart.addSeries(level.seriesOptions, false);
		
		fireEvent(chart, 'drillup', { seriesOptions: level.seriesOptions });

		if (newSeries.type === oldSeries.type) {
			newSeries.drilldownLevel = level;
			newSeries.animate = newSeries.animateDrillupTo || noop;
			newSeries.options.animation = true;

			if (oldSeries.animateDrillupFrom) {
				oldSeries.animateDrillupFrom(level);
			}
		}

		oldSeries.remove(false);

		// Reset the zoom level of the upper series
		if (newSeries.xAxis) {
			newSeries.xAxis.setExtremes(oldExtremes.xMin, oldExtremes.xMax, false);
			newSeries.yAxis.setExtremes(oldExtremes.yMin, oldExtremes.yMax, false);
		}


		this.redraw();

		if (this.drilldownLevels.length === 0) {
			this.drillUpButton = this.drillUpButton.destroy();
		} else {
			this.drillUpButton.attr({
				text: this.getDrilldownBackText()
			})
			.align();
		}
	};

	PieSeries.prototype.animateDrilldown = function (init) {
		var level = this.chart.drilldownLevels[this.chart.drilldownLevels.length - 1],
			animationOptions = this.chart.options.drilldown.animation,
			animateFrom = level.shapeArgs,
			start = animateFrom.start,
			angle = animateFrom.end - start,
			startAngle = angle / this.points.length,
			startColor = H.Color(level.color).rgba;

		if (!init) {
			each(this.points, function (point, i) {
				var endColor = H.Color(point.color).rgba;

				/*jslint unparam: true*/
				point.graphic
					.attr(H.merge(animateFrom, {
						start: start + i * startAngle,
						end: start + (i + 1) * startAngle
					}))
					.animate(point.shapeArgs, H.merge(animationOptions, {
						step: function (val, fx) {
							if (fx.prop === 'start') {
								this.attr({
									fill: tweenColors(startColor, endColor, fx.pos)
								});
		