<!-- Latest compiled and minified CSS -->

<link href="<?php echo $this->config->item('url_app') ?>css/page-master.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datatables/dataTables.min.css">

<div class="row">
	<div class="page-master col-md-12">
		<div class="pg-header">
			<div class="col-md-12">
				<div class="row">				
					<div class="col-md-7">				
						<h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Costumer</h4>
			            <nav aria-label="breadcrumb" class="d-inline-block ">
			                <ol class="breadcrumb p-0">
			                    <li class="breadcrumb-item"><a href="#"></a></li>
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
					
				</div>
			</div>
		</div>
		<div class="col-md-12" style="margin-top: 20px;">
			<div class="pg-content col-md-12">
				<table id="table-user" class="display table-action" style="width:100%">
			        <thead>
			            <tr>
			            	<th width="60">No</th>
			                <th>Username</th>
			                <th>No Hp</th>
			                <th>Alamat</th>			                
			            </tr>
			        </thead>			        
			    </table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/master/costumer/main.js"></script>