<?php
  // JCalPro router
  function jcalproBuildRoute(&$query){
      $segments = array();
      //if(isset($query['option'])) $segments[] = $query['option'];
      if(isset($query['extmode'])) {
          $segments[] = $query['extmode'];
          unset($query['extmode']);
      }
      if(isset($query['event_mode'])) {
          $segments[] = $query['event_mode'];
          unset($query['event_mode']);
      }
      if(isset($query['extid'])) {
          $segments[] = $query['extid'];
          unset($query['extid']);
      }
      if(isset($query['date'])){
          $segments[] = 'date';
          $segments[] = $query['date'];
          unset($query['date']);
      }
      if(isset($query['Itemid'])) $segments[] = $query['Itemid'];
      return $segments;
  }
  
  function jcalproParseRoute(&$segments) {
      $vars = array();
      $count = 0;
      while( $count <= count($segments) ) {
          if($segments[$count] == 'view') {
              $count++;
              $vars['extmode'] = 'view';
              $vars['extid'] = $segments[$count];
          }
          if( $segments[$count] == 'cal' || $segments[$count] == 'flat' || $segments[$count] == 'week' || $segments[$count] == 'day' || $segments[$count] == 'cats' || $segments[$count] == 'extcal_search' ) {
              $vars['extmode'] = $segments[$count];
          }
          if( $segments[$count] == 'date' ) {
              $count++;
              $vars['date'] = $segments[$count];
          }
          if( $segments[$count] == 'add' ) {
              $vars['extmode'] = 'event';
              $vars['event_mode'] = 'add';
          }
          if( $segments[$count] == 'edit' ) {
              $count++;
              $vars['extmode'] = 'event';
              $vars['event_mode'] = 'edit';
              $vars['extid'] = $segments[$count];
          }
          if( $segments[$count] == 'del' ) {
              $count++;
              $vars['extmode'] = 'event';
              $vars['event_mode'] = 'del';
              $vars['extid'] = $segments[$count];
          }
          $count++;
      }
      $var['Itemid'] = $segments[count($segments)-1];
      return $vars;
  }
?>
