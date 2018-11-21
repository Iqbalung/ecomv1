
// chartjs initialization

var option_produk = {};
var chart_produk;

var option_kategori = {};
var chart_kategori;

var option_jualan = {};
var chart_jualan;

$(function () {

// area_chart

    var ctx = document.getElementById('area_chart').getContext('2d');

    option_produk =  {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: [],
            datasets: [{
                label: "Jumlah transaksi",
                backgroundColor: 'rgba(42,192,33,.05)',
                borderColor: '#2ac021',
                pointBackgroundColor: "#ffffff",
                data: []
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            scales: {
                xAxes: [{
                    display: true,
					ticks: {
						minRotation: 70
					}
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        zeroLineColor: '#e7ecf0',
                        color: '#e7ecf0',
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }]

            },
            elements: {
                line: {
                    tension: 1,
             // tension: 0.4,
                    borderWidth: 1
                },
                point: {
                    radius: 40,
                    hitRadius: 10,
                    hoverRadius: 6,
                    borderWidth: 4
                }
            }
        }
    };
	
	chart_produk = new Chart(ctx, option_produk);
	
	var ctx2 = document.getElementById('area_chart2').getContext('2d');

    option_kategori = {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: [],
            datasets: [{
                label: "Jumlah transaksi",
                backgroundColor: 'rgba(42,192,33,.05)',
                borderColor: '#2ac021',
                pointBackgroundColor: "#ffffff",
                data: []
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            scales: {
                xAxes: [{
                    display: true
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        zeroLineColor: '#e7ecf0',
                        color: '#e7ecf0',
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }]

            },
            elements: {
                line: {
                    tension: 0.00001,
//              tension: 0.4,
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 6,
                    borderWidth: 4
                }
            }
        }
    }
	
	chart_kategori = new Chart(ctx2, option_kategori);
	
	ctx3 = document.getElementById('grafik-penjualan').getContext('2d');

    var option_jualan = {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
		data : {
            labels: [],
            datasets: [{
                fill: true,
                backgroundColor: 'rgba(122,134,255,.1)',
				label: "Total Penjualan Kotor",
              //  backgroundColor: 'rgba(42,192,33,.05)',
                borderColor: '#2ac021',
                pointBackgroundColor: "#ffffff",
                data: []

            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            scales: {
                xAxes: [{
                    display: true,
					ticks: {
						minRotation: 70
					},
                    gridLines: {
                        zeroLineColor: '#e7ecf0',
                        color: '#e7ecf0',
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        zeroLineColor: '#e7ecf0',
                        color: '#e7ecf0',
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }]

            },
            elements: {
                line: {
                    //tension: 0.00001,
                    tension: 0.4,
                    borderWidth: 1
                },
                point: {
                    radius: 2,
                    hitRadius: 10,
                    hoverRadius: 6,
                    borderWidth: 4
                }
            }
        }
    };
	
	var chart_jualan = new Chart(ctx3, option_jualan);
	
	
	function get_jualan (date1, date2, label) {
		
		$.ajax({
			url :app.data.site_url+"/dashboard/main/get_grafik_penjualan",
			type : 'POST',
			method : 'POST',
			data : {
				date1:date1,
				date2:date2,
				label : label,
			},
			success : function (data) {
				var dt = JSON.parse(data);
				var e = 0;
				var sudah_tidak_nol = 0;
				option_jualan.data.datasets[0].data = [];
				option_jualan.data.labels = [];
				var data_kanan = [];
				for ( e in dt) {
					option_jualan.data.datasets[0].data.push(dt[e].total_transaksi_harian);
					option_jualan.data.labels.push(dt[e].selected_date);
				}		
				chart_jualan.update();
				
			}
		});
	}
	
	
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_mediasale",
		type : 'POST',
		method : 'POST',
		success : function (data) {
			var dt = JSON.parse(data);
			var e = 0;
			for ( e in dt) {
				
				$('#mediasale').append("<li><small>"+dt[e].nama+"</small> <span>"+dt[e].jml+" item</span></li>");
				
				
			}
		
		}
	});
	
	//load_chart_produk_tertinggi();
	
	var start = moment().startOf('month');
	var end = moment().endOf('month');
	
	function cb(start, end, label) {
		var text = label;
		
		if (text == 'Hari ini') {
			label = 'harian';
		} else if (text == 'Kemarin') {
			label = 'harian';
		} else if (text == '7 Hari Terakhir') {
			label = 'mingguan';
		} else if (text == '30 Hari Terakhir') {
			label = 'bulanan';
		} else if (text == 'Minggu ini') {
			label = 'mingguan';
		} else if (text == 'Minggu Lalu') {
			label = 'mingguan';
		} else if (text == 'Bulan ini') {
			label = 'bulanan';
		} else if (text == 'Custom Range') {
			label = 'range';
		}
		
		
		$('.background-background').show();
		
		setTimeout(function() {
			$('.background-background').hide();
		},2000)
		
		
		$('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
		load_chart_produk_tertinggi(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), label);
		load_chart_kategori_tertinggi(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), label);
		
		load_profit(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), label);
		load_uang_masuk(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), label);
		load_transaksi(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), label);
		
		get_jualan(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), label);
		
		moment().startOf('month'), moment().endOf('month')
		
		load_penjualan_hari_ini(moment().format('YYYY-MM-DD'), moment().format('yyyy-mm-dd'), 'harian');
		load_penjualan_minggu_ini(moment().startOf('isoWeek').format('YYYY-MM-DD'), moment().endOf('isoWeek').format('YYYY-MM-DD'), 'mingguan');
		load_penjualan_bulan_ini(moment().startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD'), 'bulanan');
		
	}

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hari ini': [moment(), moment()],
           'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
           '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
           'Minggu ini': [moment().startOf('isoWeek'), moment().endOf('isoWeek') ],
           'Minggu Lalu': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
           'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
	

});




function load_chart_produk_tertinggi(date1, date2, label) {
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_produk_tertinggi",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			var e = 0;
			option_produk.data.datasets[0].data = [];
			option_produk.data.labels = [];
			for ( e in dt) {
				option_produk.data.datasets[0].data.push(dt[e].jml_trx);
				option_produk.data.labels.push(dt[e].prod_name_short);
			}		
			chart_produk.update();
		
		}
	});
}

function load_chart_kategori_tertinggi(date1, date2, label) {
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_kategori_tertinggi",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			var e = 0;
			option_kategori.data.datasets[0].data = [];
			option_kategori.data.labels = [];
			for ( e in dt) {
				option_kategori.data.datasets[0].data.push(dt[e].jml_trx);
				option_kategori.data.labels.push(dt[e].category_name);
			}		
			chart_kategori.update();
		
		}
	});
}

function load_penjualan_hari_ini(date1,date2, label) {
	
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_total_uang_masuk",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			
			if (dt.result == '+' ) {
			
				$('#hari_ini').html(dt.jml+' <i class="fa fa-long-arrow-up text-success f14"></i>');
			} else {
				
				$('#hari_ini').html(dt.jml+' <i class="fa fa-long-arrow-down text-danger f14"></i>');
			}
		}
	});

}

function load_penjualan_minggu_ini(date1,date2, label) {
	
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_total_uang_masuk",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			
			if (dt.result == '+' ) {
			
				$('#minggu_ini').html(dt.jml+' <i class="fa fa-long-arrow-up text-success f14"></i>');
			} else {
			
				$('#minggu_ini').html(dt.jml+' <i class="fa fa-long-arrow-down text-danger f14"></i>');
			}
		}
	});
	
}

function load_penjualan_bulan_ini(date1, date2, label) {
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_total_uang_masuk",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			
			if (dt.result == '+' ) {
				
				$('#bulan_ini').html(dt.jml+' <i class="fa fa-long-arrow-up text-success f14"></i>');
			} else {
			
				$('#bulan_ini').html(dt.jml+' <i class="fa fa-long-arrow-down text-danger f14"></i>');
			}
		}
	});

}

function load_profit(date1, date2, label) {
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_profit",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			$('#uang_profit').html(dt.jml);
			$('#compare_uang_profit').html(dt.compare);
			
			if (dt.result == '+' ) {
				$('#indicator_uang_profit').removeClass('text-danger');
				$('#compare_uang_profit').removeClass('text-danger');
				$('#indicator_uang_profit').addClass('text-success');
				$('#compare_uang_profit').addClass('text-success');
				$('#indicator_uang_profit').html("<i style='font-size:30px;' class='fa fa-long-arrow-up' ></i>");
			} else {
				$('#indicator_uang_profit').removeClass('text-success');
				$('#compare_uang_profit').removeClass('text-success');
				$('#indicator_uang_profit').addClass('text-danger');
				$('#compare_uang_profit').addClass('text-danger');
				$('#indicator_uang_profit').html("<i style='font-size:30px;' class='fa fa-long-arrow-down' ></i>");
			}
			
		}
	});
}

function load_uang_masuk(date1,date2, label) {
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_total_uang_masuk",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			$('#uang_masuk').html(dt.jml);
			$('#compare_uang_masuk').html(dt.compare);
			
			if (dt.result == '+' ) {
				$('#indicator_uang_masuk').removeClass('text-danger');
				$('#compare_uang_masuk').removeClass('text-danger');
				$('#indicator_uang_masuk').addClass('text-success');
				$('#compare_uang_masuk').addClass('text-success');
				$('#indicator_uang_masuk').html("<i style='font-size:30px;' class='fa fa-long-arrow-up' ></i>");
			} else {
				$('#indicator_uang_masuk').removeClass('text-success');
				$('#compare_uang_masuk').removeClass('text-success');
				$('#indicator_uang_masuk').addClass('text-danger');
				$('#compare_uang_masuk').addClass('text-danger');
				$('#indicator_uang_masuk').html("<i style='font-size:30px;' class='fa fa-long-arrow-down' ></i>");
			}
		}
	});
}

function load_transaksi(date1,date2, label) {
	
	$.ajax({
		url :app.data.site_url+"/dashboard/main/get_jumlahtransaksi_range",
		type : 'POST',
		method : 'POST',
		data : {
			date1:date1,
			date2:date2,
			label : label,
		},
		success : function (data) {
			var dt = JSON.parse(data);
			$('#transaksi_jumlah').html(dt.jml);
			$('#transaksi_diterima').html(dt.jml);
			$('#compare_transaksi').html(dt.compare);
			
			if (dt.result == '+' ) {
				$('#indicator_jml_transaksi').removeClass('text-danger');
				$('#compare_transaksi').removeClass('text-danger');
				$('#indicator_jml_transaksi').addClass('text-success');
				$('#compare_transaksi').addClass('text-success');
				$('#indicator_jml_transaksi').html("<i style='font-size:30px;' class='fa fa-long-arrow-up' ></i>");
			} else {
				$('#indicator_jml_transaksi').removeClass('text-success');
				$('#compare_transaksi').removeClass('text-success');
				$('#indicator_jml_transaksi').addClass('text-danger');
				$('#compare_transaksi').addClass('text-danger');
				$('#indicator_jml_transaksi').html("<i style='font-size:30px;' class='fa fa-long-arrow-down' ></i>");
			}
			
		}
	});

}





