<div class="container-fluid">
    <!--page title-->
    <div class="page-title mb-4 d-flex align-items-center">
        <div class="mr-auto">
            <h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Product</h4>
            <nav aria-label="breadcrumb" class="d-inline-block ">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item"><a href="#">Add</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
					<button type="button" class="btn btn-lg btn-action btn-light bg-transaparant" id="btn-action-batal">Batal</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                     <button type="button" class="btn btn-lg btn-action btn-dark bg-dark" id="btn-action-simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <form id="form-produck" class="form form-default">
	    <div class="row">        
			<div class="col-md-6">
				<div class="card card-shadow mb-4">
				    <div class="card-header border-0">
				        <div class="custom-title-wrap bar-info">
				            <div class="custom-title">Informasi Barang</div>
				        </div>
				    </div>
				    <div class="card-body">
				        <div class="form form-default">
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Kode Barang</label>
				                    <input type="hidden" class="form-control rounded-0" name="prod_id">
				                <div class="col-sm-4">
				                    <input type="text" class="form-control rounded-0" name="prod_code">
				                </div>
				            </div>
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Nama Barang</label>
				                <div class="col-sm-8">
				                    <input type="text" class="form-control rounded-0" name="prod_name">
				                </div>
				            </div>          
				            <div class="form-group row">	                
								<label class="col-sm-4 col-form-label">Nama Lain Barang</label>					
				    			<div class="col-sm-8 input-group">			            				
									<input type="text" class="form-control rounded-0" name="prod_name_short">						  
								</div>
							</div>
							<div class="form-group row">	                
								<label class="col-sm-4 col-form-label">Warna</label>					
				    			<div class="col-sm-5 input-group">			            				
									<input type="text" class="form-control rounded-0" name="prod_colour">						  
								</div>
							</div>	
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Keterangan</label>
				                <div class="col-sm-8">
				                    <textarea class="form-control rounded-0" name="prod_desc" rows="3"></textarea>
				                </div>
				            </div>
				            <!-- <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Jenis</label>
				                <div class="col-sm-6">
				                	<select class="form-control rounded-0 selct2" name="prod_kind">
				                		<option value="barang">Barang</option>
				                	</select>                        
				                </div>
				            </div> -->
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Kategori</label>
				                <div class="col-sm-6">
				                	<select class="form-control rounded-0 selct2" name="category_id">
				                		
				                	</select>                        
				                </div>
				            </div>
				            <!-- <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Satuan</label>
				                <div class="col-sm-5">
				                	<select class="form-control rounded-0 selct2" name="prod_">
				                		<option value="pak">Pak</option>
				                	</select>                        
				                </div>
				            </div>
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Divisi/Departemen</label>
				                <div class="col-sm-5">
				                	<select class="form-control rounded-0 selct2" name="prod_">
				                		<option value="pa-">-</option>
				                	</select>                        
				                </div>
				            </div>
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Kelompok</label>
				                <div class="col-sm-5">
				                	<select class="form-control rounded-0 selct2" name="prod_">
				                		<option value="pa-">-</option>
				                	</select>                        
				                </div>
				            </div> -->
				            <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Pemasok</label>
				                <div class="col-sm-5">
				                	<select class="form-control rounded-0 selct2" name="prod_suplier">
				                		<option value="pa-">-</option>
				                	</select>                        
				                </div>
				            </div>
				            <!-- <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Pajak</label>
				                <div class="col-sm-5">
				                	<select class="form-control rounded-0 selct2" name="prod_">
				                		<option value="pa-">-</option>
				                	</select>                        
				                </div>
				            </div> -->
				            <div class="form-group row">	                
								<label class="col-sm-4 col-form-label">Barcode</label>					
				    			<div class="col-sm-6 input-group">			            				
									<input type="text" class="form-control rounded-0" name="prod_barcode">
									  <div class="input-group-append">
				                        <span class="input-group-text bg-white"><i class="fa fa-barcode"></i></span>
				                    </div>
								</div>
							</div>											
							<!-- <div class="form-group row">	                
								<label class="col-sm-4 col-form-label">Komisi</label>					
				    			<div class="col-sm-3 input-group">			            				
									<input type="text" class="form-control rounded-0" name="prod_">
									  <div class="input-group-append">
				                        <span class="input-group-text bg-transaparant bordered-none">%</span>
				                    </div>
								</div>
							</div>
							<div class="form-group row">	                
								<label class="col-sm-4 col-form-label">Jumlah Reward</label>					
				    			<div class="col-sm-2 input-group">			            				
									<input type="text" class="form-control rounded-0" name="prod_">						  
								</div>
							</div>
							<div class="form-group row">	                
								<label class="col-sm-4 col-form-label">Nilai Voucher</label>					
				    			<div class="col-sm-5 input-group">			            				
									<input type="text" class="form-control rounded-0" name="prod_">						  
								</div>
							</div> -->
				        </div>
				    </div>
				</div>
			</div>
			<div class="col-md-6 padding-5">
				<div class="bg-white tab-form-product">
			        <ul class="nav nav-tabs mb-4" role="tablist">
			            <li class="nav-item">
			                <a class="nav-link active" data-toggle="tab" href="#tab_stock">Stok</a>
			            </li>		           
			           <li class="nav-item">
			                <a class="nav-link" data-toggle="tab" href="#tab_varian">Varian</a>
			            </li>
			        </ul>

			        <div class="tab-content">
			            <div class="tab-pane active" id="tab_stock" role="tabpanel">
			                 <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Stok Minimal</label>
				                <div class="col-sm-4">
				                    <input type="text" class="form-control rounded-0" name="prod_stock_minimal">
				                </div>
				            </div>
				             <div class="form-group row">
				                <label class="col-sm-4 col-form-label">Stok </label>
				                <div class="col-sm-4">
				                    <input type="text" class="form-control rounded-0" name="prod_piece">
				                </div>
				            </div>
			            </div>
			            <div class="tab-pane" id="tab_varian" role="tabpanel">
			                <div id="variant"></div>
			                <div class="row">
			                	<div class="col-md-4">
				                	<div class="form-group">
				                		<input type="text" class="input-value form-control" placeholder="Varian" name="value">
				                	</div>
			                	</div>
			                	<div class="col-md-4">
				                	<div class="form-group">
				                		<input type="number" class="input-stock form-control" placeholder="Stock" name="stock">
				                	</div>
			                	</div>
			                	<div class="col-md-4">
			                		<button type="button" class="btn btn-lg btn-action btn-dark bg-dark" id="btn-action-simpan-variant">S</button>
			                	</div>
			              
			            	</div>
			           	</div>
			            <div class="tab-pane" id="tab_lain" role="tabpanel">
			            </div>		           
			        </div>
			    </div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/product/form.js"></script>