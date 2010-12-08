<?php
	class Pagination{
		var $url;
		var $page;
		var $page_limit;
		var $total_rec;
		
		function __construct($url, $total_rec, $page_limit, $current_page){
			$this->url = $url;
			$this->page = $current_page;
			$this->total_rec = $total_rec;
			$this->page_limit = $page_limit;
		}
		
		function getTotalPage(){
			if($this->total_rec > $this->page_limit)
				$total_page = ceil($this->total_rec / $this->page_limit);
			else
				$total_page = 1;
			
			return $total_page;
		}
		
		function getOffset(){
			$ttl_page = $this->getTotalPage();
			$abs_page = ($ttl_page >= $this->page) ? ($this->page - 1) : ($ttl_page - 1);
			return ($abs_page * $this->page_limit);
		}
		function getPagination(){
			$from = ($this->page - 1) * $this->page_limit;
			$to = ($this->total_rec > ($this->page_limit * $this->page)) ? ($this->page_limit * $this->page) : $this->total_rec;
			$text = sprintf("<em>Displaying %d to %d of %d</em>", ($from+1), $to, $this->total_rec);
			$html = "<span style='float:right'>Page <select name=\"page\" onChange=\"JavaScript: Pagination(this.value,'{$this->url}');\">";
			for($i=1; $i <= $this->getTotalPage(); $i++){
				$selected = ($this->page == $i) ? "selected" : "";
				$html .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
			}
			$html .= "</select></span>";
			
			$html = $text . " " . $html;
			$form = '<form method="get" action="'.$this->url.'">
						<input type="hidden" name="page" value="">
					</form>';
			$html .= $form;
			return $html;
		}
	}
?>
