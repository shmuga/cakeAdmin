<script src="/js/jquery-1.10.2.js"></script>
<script src="/js/bootstrap.js"></script>
<script>$('#cat0').collapse();</script>
<?php

	$this->Tree->genTreeRadio('StolikisCategory', $cat);
	debug($cat);

?>