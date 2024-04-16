$(function () {
	"use strict";

	// chart 1
	var options = {
		series: [{
			name: 'Sales Overview Daily',
			data: dailyOverviewTot
		}],
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'bar',
			zoom: {
				enabled: false
			},
			toolbar: {
				show: false
			},
		},
		stroke: {
			width: 0,
			curve: 'smooth'
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		grid: {
			borderColor: 'rgba(255, 255, 255, 0.15)',
			strokeDashArray: 4,
			yaxis: {
				lines: {
					show: true
				}
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
			  shade: 'light',
			  type: 'vertical',
			  shadeIntensity: 0.5,
			  gradientToColors: ['#01e195'],
			  inverseColors: true,
			  opacityFrom: 1,
			  opacityTo: 1,
			}
		  },
		colors: ['#0d6efd'],
		dataLabels: {
			enabled: false,
			enabledOnSeries: [1]
		},
		xaxis: {
			categories: salesdayName,
		},
	};
	var chart = new ApexCharts(document.querySelector("#chart1"), options);
	chart.render();

// chart 2

var options = {
		series: [{
			name: 'Sales Overview Weekly',
			data: weekOverviewTot
		}],
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'bar',
			zoom: {
				enabled: false
			},
			toolbar: {
				show: false
			},
		},
		stroke: {
			width: 0,
			curve: 'smooth'
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		grid: {
			borderColor: 'rgba(255, 255, 255, 0.15)',
			strokeDashArray: 4,
			yaxis: {
				lines: {
					show: true
				}
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
			  shade: 'light',
			  type: 'vertical',
			  shadeIntensity: 0.5,
			  gradientToColors: ['#01e195'],
			  inverseColors: true,
			  opacityFrom: 1,
			  opacityTo: 1,
			}
		  },
		colors: ['#0d6efd'],
		dataLabels: {
			enabled: false,
			enabledOnSeries: [1]
		},
		xaxis: {
			categories: salesweekNum,
		},
	};
	var chart = new ApexCharts(document.querySelector("#chart2"), options);
	chart.render();

  // chart 3

	var options = {
		series: [{
			name: 'Sales Overview Monthly',
			data: monthOverviewTot
		}],
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'bar',
			zoom: {
				enabled: false
			},
			toolbar: {
				show: false
			},
		},
		stroke: {
			width: 0,
			curve: 'smooth'
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		grid: {
			borderColor: 'rgba(255, 255, 255, 0.15)',
			strokeDashArray: 4,
			yaxis: {
				lines: {
					show: true
				}
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
			  shade: 'light',
			  type: 'vertical',
			  shadeIntensity: 0.5,
			  gradientToColors: ['#01e195'],
			  inverseColors: true,
			  opacityFrom: 1,
			  opacityTo: 1,
			}
		  },
		colors: ['#0d6efd'],
		dataLabels: {
			enabled: false,
			enabledOnSeries: [1]
		},
		xaxis: {
			categories: monthName,
		},
	};
	var chart = new ApexCharts(document.querySelector("#chart3"), options);
	chart.render();

  // chart 4

  var options = {
		series: [{
			name: 'Sales Overview Yearly',
			data: yearOverviewTot
		}],
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'bar',
			zoom: {
				enabled: false
			},
			toolbar: {
				show: false
			},
		},
		stroke: {
			width: 0,
			curve: 'smooth'
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		grid: {
			borderColor: 'rgba(255, 255, 255, 0.15)',
			strokeDashArray: 4,
			yaxis: {
				lines: {
					show: true
				}
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
			  shade: 'light',
			  type: 'vertical',
			  shadeIntensity: 0.5,
			  gradientToColors: ['#01e195'],
			  inverseColors: true,
			  opacityFrom: 1,
			  opacityTo: 1,
			}
		  },
		colors: ['#0d6efd'],
		dataLabels: {
			enabled: false,
			enabledOnSeries: [1]
		},
		xaxis: {
			categories: salesyearNum,
		},
	};
	var chart = new ApexCharts(document.querySelector("#chart4"), options);
	chart.render();    	
});