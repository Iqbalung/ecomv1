<!-- Latest compiled and minified CSS -->

<link href="<?php echo $this->config->item('url_app') ?>css/page-master.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datatables/dataTables.min.css">

<div class="row">
	<div class="page-master col-md-12">
		<div class="pg-header">
			<div class="col-md-12">
				<div class="row">				
					<div class="col-md-7">				
						<h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Courier</h4>
			            <nav aria-label="breadcrumb" class="d-inline-block ">
			                <ol class="breadcrumb p-0">
			                    <li class="breadcrumb-item"><a href="#">Manage Product</a></li>
			                </ol>
			            </nav>	
					</div>
					<div class="col-md-4 padding-5">				
						<div class="input-group">
                                <input type="text" class="form-control f-search" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-success bg-white btn-f-search" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
					</div>
					<div class="col-md-1 padding-5">
						<a class="btn btn-default btn-success btn-flat btn-box bg-green" id="btn-add-product" href=""><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12" style="margin-top: 20px;">
			<div class="pg-content col-md-12">
				<table id="table-product" class="display table-action" style="width:100%">
			        <thead>
			            <tr>
			            	<th width="60">No</th>
			            	<th>Code</th>
			                <th>Name</th>			                
			                <th>Suplier</th>
			                <th>Description</th>
			                <th width="120" align="center"></th>
			            </tr>
			        </thead>			        
			    </table>
			</div>
		</div>
	</div>
</div>

<?php $this->view("inc/master/product/modal"); ?>

<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/master/product/main.js"></script>