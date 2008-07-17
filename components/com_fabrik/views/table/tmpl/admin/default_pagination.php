<?php
/* MOS Intruder Alerts */
defined('_JEXEC') or die();

/**
 * makes the table navigation html to traverse the table data
 * @param int the total number of records in the table
 * @param int number of records to show per page
 * @param int which record number to start at
 */

require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );

/**
 * extension to the normal pagenav functions
 * $total, $limitstart, $limit
 */

class fabrikPageNav extends mosPageNav{
	
	var $_formName = 'fabrikTable';

	function getPagesLinks() {
		$html 				= '';
		$displayed_pages 	= 10;
		if($this->limit == 0){
			$this->limit = 10;
		}
		$total_pages 		= ceil( $this->total / $this->limit );
		$this_page 			= ceil( ($this->limitstart+1) / $this->limit );
		$start_loop 		= (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		if (!defined( '_PN_LT' ) || !defined( '_PN_RT' ) ) {
			DEFINE('_PN_LT','&lt;');
			DEFINE('_PN_RT','&gt;');
		}

		$pnSpace = '';
		if (_PN_LT || _PN_RT) $pnSpace = "&nbsp;";
		
		
		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			$html .= "<div class='button2-right'>";
			$html .= "\n<div class=\"start\"><a href=\"#beg\" title=\"first page\" onclick=\"javascript:oTable.fabrikNav(0);return false;\">".  _PN_START ."</a></div>";
			$html .= "</div><div class='button2-right'>";
			$html .= "\n<div class=\"prev\"><a href=\"#prev\" title=\"previous page\" onclick=\"javascript:oTable.fabrikNav($page);return false;\">" . _PN_PREVIOUS . "</a></div>";
		} else {
			$html .= "<div class='button2-right off'>";
			$html .= "\n<div class=\"start\"><span class=\"pagenav\">" . _PN_START ."</span></div>";
			$html .= "</div><div class='button2-right off'>";
			$html .= "\n<div class=\"prev\"><span class=\"pagenav\">" . _PN_PREVIOUS . "</span></div>";
		}
		$html .= "</div>";
		
		$html .= "<div class='button2-left'><div class='page'>";
		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page) {
				$html .= "\n<span> $i </span>";
			} else {
				$html .= "\n<a href=\"#$i\" class=\"pagenav\" onclick=\"javascript:oTable.fabrikNav($page);return false;\">$i</a>";
			}
		}
		$html .= "</div></div>";
		
		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$html .= "<div class='button2-left'>";
			$html .= "\n<div class=\"next\"><a href=\"#next\" title=\"next page\" onclick=\"javascript:oTable.fabrikNav($page);;return false;\">" . _PN_NEXT .  "</a></div>";
			$html .= "</div><div class='button2-left'>";
			$html .= "\n<div class=\"end\"><a href=\"#end\" title=\"end page\" onclick=\"javascript:oTable.fabrikNav($end_page);return false;\"> " . _PN_END ."</a></div>";
		} else {
			$html .= "<div class='button2-left off'>";
			$html .= "\n<div class=\"next\"><span>" . _PN_NEXT . "</span></div>";
			$html .= "</div><div class='button2-left off'>";
			$html .= "\n<div class=\"end\"><span>" . _PN_END  . "</span></div>";
		}
		$html .= "</div>";
		return $html;
	}

	function getListFooter( $tableId = '' ) {
		$html = '<table class="adminlist"><tfoot><tr><td colspan="6"><div class="pagination">';
		$html .= $this->getLimitBox( $tableId ) ;
		$html .= $this->getPagesLinks();
		$html .= "<div class='limit'>" .$this->getPagesCounter() . "</div>";
		$html .= '</div></td></tr></tfoot></table>';
  		return $html;
	}
	
	/**
	 * @param int id of table
	 * @return string The html for the limit # input box
	 */
	function getLimitBox ( $tableId ='' ) {
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) {
			$limits[] = JHTML::_('select.option', "$i" );
		}
		$limits[] = JHTML::_('select.option', "50" );

		// build the html select list
		$id = ( $tableId != '' ) ?  "table_" . $tableId . "_limit" : "limit";
		$options = 'class="inputbox" size="1" id="'.$id.'"';
		$html = "<div class='limit'>"  . 'Display #'. JHTML::_('select.genericlist',  $limits, 'limit', $options,
		'value', 'text', $this->limit, $id );
		//was commented out but made the front end table not work in J1.0.x
		$html .= "\n<input type=\"hidden\"  name=\"limitstart\" value=\"$this->limitstart\" /></div>";
		return $html;
	}
}

?>