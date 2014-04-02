<?php

	class TreeHelper extends AppHelper {
		public $helpers = array('Form');
		private function _genTreeLevel($catalog, $data, $parent) {
			foreach ($data as $key => $value) :
				if (!empty($value['children'])) $flag = 1;
				else $flag = 0;
				?>
			<div class="panel-group" id="cat<?=$parent;?>">
				<div class="panel panel-default">
					<div class="panel-heading">						
					  	<h4 class="panel-title">
					  		<?if ($flag):?>

					  		<a data-toggle="collapse" data-parent="#cat<?=$parent;?>" href="#cat<?=$value[$catalog]['id'];?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;<strong><?=$value[$catalog]['name'];?></strong></a>
					  		<?else:?>
					  		<span><?=$value[$catalog]['name'];?></span>				
					  		<?endif;?>
							<span class="pull-right">
								<a role="button" class="btn btn-primary btn-xs" href="/admin/categoriesadd/<?=substr(strtolower(str_replace("Category", "",$catalog)),0,-1)?>/<?=$value[$catalog]['id'];?>" title="Добавить подкатегорию"><i class="glyphicon glyphicon-arrow-down"></i></a>
                				<a role="button" class="btn btn-primary btn-xs"  href="/admin/categoriesdelete/<?=substr(strtolower(str_replace("Category", "",$catalog)),0,-1)?>/<?=$value[$catalog]['id'];?>" title="Удалить текущую категорию"><i class="glyphicon glyphicon-remove"></i></a>
							</span>
						</h4>
					</div>
					<?if ($flag):?>
					<div id="cat<?=$value[$catalog]['id'];?>" class="panel-collapse collapse">
						<div class="panel-body">
							<?php
								if ($flag) {
									$this->_genTreeLevel($catalog, $value['children'], $value[$catalog]['id']);
								}
							?>
      					</div>
					</div>
					<?endif;?>
				</div>
			</div>

				<?php
			endforeach;
		}


		private function _genTreeLevelRadio($catalog, $data, $parent,$for) {
			foreach ($data as $key => $value) :
				if (!empty($value['children'])) $flag = 1;
				else $flag = 0;
				?>
			<div class="panel-group" id="cat<?=$parent;?>">
				<div class="panel panel-default">
					<div class="panel-heading">						
					  	<h4 class="panel-title">
					  		<?if ($flag):?>
					  		<a data-toggle="collapse" data-parent="#cat<?=$parent;?>" href="#cat<?=$value[$catalog]['id'];?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;<strong><?=$value[$catalog]['name'];?></strong></a>
					  		<?else:?>
					  		<span><?=$value[$catalog]['name'];?>
					  			<label class="pull-right">
					  				Выбрать&nbsp;
					  			<input type="radio" name="data[<?=$for[0]?>][<?=$for[1]?>]" value="<?=$value[$catalog]['id']?>" class="pull-right">
					  			</label>
					  		</span>				
					  		<?endif;?>
						</h4>
					</div>
					<?if ($flag):?>
					<div id="cat<?=$value[$catalog]['id'];?>" class="panel-collapse collapse">
						<div class="panel-body">
							<? if ($flag) {
									$this->_genTreeLevelRadio($catalog, $value['children'], $value[$catalog]['id'],$for);
								}
							?>
      					</div>
					</div>
					<?endif;?>
				</div>
			</div>

				<?php
			endforeach;
		}


		public function genTree($catalog, $data) {
			?>
			<div class="panel-group" id="cat0">
				<?php
					$this->_genTreeLevel($catalog, $data, 0);
				?>
			</div>
			<?php
		}

		public function genTreeRadio($catalog, $data, $for) {
			?>
				<form>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
      							<h4 class="panel-title">
        							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          								<i class="glyphicon glyphicon-plus"></i><strong>Все</strong>
        							</a>
						      	</h4>
						    </div>
						    <div id="collapseOne" class="panel-collapse collapse">
      							<div class="panel-body">
									<div class="panel-group" id="cat0">
										<?php
											$this->_genTreeLevelRadio($catalog, $data, 0, $for);
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			<?php
		}
	}

?>