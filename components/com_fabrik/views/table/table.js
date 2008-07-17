/**
 * @author Robert
 */
var MochaSearch = new Class({
  initialize: function(){
  },
  
  conf: function(fields, addFirst, addApply){
    this.trs = $A();
    this.condOpts = [new Element('option', {
      value: '<>'
    }).appendText('NOT EQUALS'), new Element('option', {
      value: '='
    }).appendText('EQUALS'), new Element('option', {
      value: 'like'
    }).appendText('BEGINS WITH'), new Element('option', {
      value: 'like'
    }).appendText('CONTAINS'), new Element('option', {
      value: 'like'
    }).appendText('ENDS WITH'), new Element('option', {
      value: '>'
    }).appendText('GREATER THAN'), new Element('option', {
      value: '<'
    }).appendText('LESS THAN')];
    this.joinOpts = [new Element('option', {
      value: 'AND'
    }).appendText('AND'), new Element('option', {
      value: 'OR'
    }).appendText('OR')];
    this.options = Object.extend({
      admin: false,
      txtApply: 'Apply',
      tableid: 0,
      txtClear: 'Clear',
      txtClose: 'Close',
      headings: ['Join', 'Field', 'Condition', 'Value', 'Active', 'Delete'],
      
      filterCondDd: new Element('select', {
        'name': 'conditions',
        'id': 'conditions',
        'class': 'inputbox',
        'size': '1'
      }).adopt(this.condOpts)
    }, arguments[3] ||
    {});
    
    this.fields = $A();
    fields.each(function(f){
      this.fields.push(new Element('option', {
        'value': f.value
      }).appendText(f.text));
    }.bind(this))
    this.counter = 0;
    this.onDeleteClick = this.deleteFilterOption.bindAsEventListener(this);
    this.onAdd = this.addRow.bindAsEventListener(this);
    this.onClear = this.resetForm.bindAsEventListener(this);
    this.onRemoveRow = this.removeRow.bindAsEventListener(this);
    this.onApply = this.applyFilters.bindAsEventListener(this);
    this.addApply = addApply;
    this.setUp(addFirst);
  },
  
  setUp: function(addFirst){
    this.content = new Element('div');
		var apply = new Element('span');
    //if (this.addApply) {
      var apply = new Element('input', {
        'type': 'button',
        'id': 'advanced-search-apply',
        'name': 'applyAdvFabrikFilter',
        'class': 'button fabrikFilter',
        'value': this.options.txtApply
      });
   // }
    var cancel = new Element('input', {
      'type': 'button',
      'class': 'button',
      'value': this.options.txtClear,
      'id': 'advancedFilterTable-clearall'
    });
    
    var container = new Element('div', {
      'id': 'advancedSearchContainer'
    });
		
    var table = new Element('table', {
      'id': 'advanced-search-table'
    }).adopt(new Element('tbody').adopt(this.headings()));
    
		if (addFirst) {
      this.addFilterOption();
    }
		
    container.adopt(table);
    var addLink = new Element('a', {
      'href': '#',
      'id': 'advanced-search-add'
    }).appendText('add');
    
		this.content.adopt([addLink, container, apply, cancel]);

  },
  
  applyFilters: function(){
    oPackage.submitfabrikTable(this.options.tableid, 'filter');
  },
  
  headings: function(){
    var tr = new Element('tr', {
      'class': 'title'
    });
    this.options.headings.each(function(h){
      var th = new Element('th').appendText(h);
      tr.appendChild(th);
    });
    return tr;
  },
  
  makeEvents: function(){
    if ($('advanced-search-add')) {
      $('advanced-search-add').addEvent("click", this.onAdd);
      $('advancedFilterTable-clearall').addEvent("click", this.onClear);
      this.trs.each(function(tr){
        tr.injectAfter($('advanced-search-table').getElements('tr').getLast());
      })
    }
    
    if ($('advanced-search-apply')) {
      $('advanced-search-apply').addEvent("click", this.onApply);
    }
    this.watchDelete();
  },
  
  watchDelete: function(){
    $$('.advanced-search-remove-row').removeEvents();
    $$('.advanced-search-remove-row').addEvent('click', this.onRemoveRow);
  },
  
  addRow: function(){
    var tr = $('advanced-search-table').getElements('tr').getLast();
    var clone = tr.clone();
    clone.injectAfter(tr);
    this._joinSelect().injectInside(clone.getElement('td').empty());
    this.watchDelete();
  },
  
  removeRow: function(event){
    var e = new Event(event);
    e.stop();
    if ($$('.advanced-search-remove-row').length > 1) {
      var tr = e.target.findUp('tr');
      var fx = new Fx.Styles(tr, {
        duration: 800,
        transition: Fx.Transitions.Quart.easeOut,
        onComplete: function(){
          tr.remove();
        }
      });
      fx.start({
        'height': 0,
        'opacity': 0
      })
    }
  },
  
  resetForm: function(){
    var table = $('advanced-search-table');
		if(!table)
			return;
    var div = table.getParent();
    this.counter = 0;
    if (!window.ie) {
      table.empty();
    }
    else {
      //cant empty a table in IE - and cant empty the div as we then loose ref to the drop downs for some god forsaken reason
      tbody = table.getElement('tbody');
      tbody.getElements('tr').each(function(tr){
        tr.remove();
      });
    }
    div.empty();
    
    this._fieldDd = null;
    this._condDd = null;
    this._joinDd = null;
    var table = new Element('table', {
      'id': 'advanced-search-table'
    });
    table.adopt(new Element('tbody').adopt([this.headings(), this.getFilterOption()]));
    table.injectInside(div);
    this.watchDelete();
  },
  
  addFilterOption: function(selJoin, selFilter, selCondition, selValue){
    this.trs.push(this.getFilterOption(selJoin, selFilter, selCondition, selValue));
    this.counter++;
    
  },
  _joinSelect: function(sel){
    if (!this._joinDd) {
      sel = sel ? sel : '';
      var joinOpts = this.joinOpts.copy();
      joinOpts.each(function(opt){
        opt.selected = (opt.value == sel) ? true : false;
      });
      this._joinDd = new Element('select', {
        'name': 'join',
        'id': 'join',
        'class': 'inputbox',
        'size': '1'
      }).adopt(joinOpts);
      return this._joinDd;
    }
    else {
      var clone = this._joinDd.clone();
      var opts = this.joinOpts.copy();
      x = 0;
      opts.each(function(opt, y){
        if (opt.value == sel) {
          x = y;
        }
      });
      clone.selectedIndex = x;
      return clone;
    }
  },
  
  _fieldSelect: function(sel){
    sel = sel ? sel : '';
    if (!this._fieldDd) {
      var x = 0;
      var opts = this.fields.copy();
      opts.each(function(opt, y){
        if (opt.value == sel) 
          x = y;
      });
      this._fieldDd = new Element('select', {
        'name': 'search_key',
        'id': 'search_key',
        'class': 'inputbox',
        'size': '1'
      }).adopt(opts);
      this._fieldDd.selectedIndex = x;
      return this._fieldDd;
    }
    else {
      //have to clone or the ref to actual html element is returned
      var clone = this._fieldDd.clone();
      x = 0;
      this.fields.copy().each(function(opt, y){
        if (opt.value == sel) {
          x = y;
        }
      });
      clone.selectedIndex = x;
      return clone;
    }
  },
  
  _condSelect: function(sel){
    sel = sel ? sel : '';
    if (!this._condDd) {
      var opts = this.condOpts.copy();
      var x = 0;
      opts.each(function(opt, y){
        if (opt.innerHTML == sel) 
          x = y;
      })
      this._condDd = new Element('select', {
        'name': 'search_key',
        'id': 'search_key',
        'class': 'inputbox',
        'size': '1'
      }).adopt(opts);
      this._condDd.selectedIndex = x;
      return this._condDd;
    }
    else {
      //have to clone or the ref to actual html element is returned
      var clone = this._condDd.clone();
      var opts = this.condOpts.copy();
      x = 0;
      opts.each(function(opt, y){
        if (opt.innerHTML == sel) 
          x = y;
      });
      clone.selectedIndex = x;
      return clone;
    }
  },
  
  getFilterOption: function(selJoin, selFilter, selCondition, selValue){
    selJoin = selJoin ? selJoin : '';
    selFilter = selFilter ? selFilter : '';
    selCondition = selCondition ? selCondition : '';
    selValue = selValue ? selValue : '';
    
    var joinDd = (this.counter == 0) ? new Element('span').appendText('WHERE') : this._joinSelect(selJoin);
    
    var chx = (selJoin != '' || selFilter != '' || selCondition != '' || selValue != '') ? true : false;
    var chx = 'checked';
    
    //@TODO: the checked option isnt working
    
    var chkBox = new Element('input', {
      'type': 'checkbox',
      'name': 'active[]',
      'checked': chx,
      'id': 'active_' + this.counter
    });
    chkBox.checked = true;
    var tr = new Element('tr').adopt([new Element('td').adopt(joinDd), new Element('td').adopt(this._fieldSelect(selFilter)), new Element('td').adopt(this._condSelect(selCondition)), new Element('td').adopt(new Element('input', {
      'type': 'field',
      'name': 'value',
      'value': selValue
    })), new Element('td').adopt(chkBox), new Element('td').adopt(new Element('a', {
      'href': '#',
      'class': 'advanced-search-remove-row'
    }).appendText('[-]'))]);
    
    this.counter++;
    return tr;
    
  },
  
  deleteFilterOption: function(e){
    var event = new Event(e);
    element = event.target;
    $(element.id).removeEvent("click", this.onDeleteClick);
    var tr = element.parentNode.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    event.stop();
  },
  
  getSQL: function(){
    if (!$('advanced-search-table')) {
      return;
    }
    var tBody = $('advanced-search-table').getElement('tbody');
    var trs = $('advanced-search-table').getElements('tr').slice(1);
    var str = '';
    ok = true;
    trs.each(function(tr){
      var chbox = tr.getElement('input[name^=active]');
      if (chbox.checked) {
        var tmpstr = '';
        var fType = '';
        var dds = $A(tr.getElementsByTagName('SELECT'));
        ok = true;
        dds.each(function(dd){
          if (dd.name == "search_key") {
            fType = dd.options[dd.options.selectedIndex].innerHTML;
          }
          var thisstr = (dd).getValue();
          if (thisstr == '') {
            ok = false;
          }
          else {
            tmpstr = tmpstr + thisstr + ' ';
          }
        })
        if (ok) {
          var field = tr.getElement('input[name=value]');
          if (field.value != '') {
            var fVal = field.value;
            switch (fType) {
              case 'BEGINS WITH':
                fVal = fVal + "%";
                break;
              case 'CONTAINS':
                fVal = "%" + fVal + "%";
                break;
              case 'ENDS WITH':
                fVal = "%" + fVal;
                break;
              default:
                break;
            }
            str = str + tmpstr + '"' + fVal + '" ';
          }
          else {
          }
        }
      }
    })
    $('advancedFilterContainer').value = str;
    return ok;
  }
})

var mochaSearch = new MochaSearch();

var fabrikTable = new Class({

  initialize: function(id){
    this.id = id;
    this.listenTo = $A();
    this.options = Object.extend({
      'admin': false,
			'filterMethod':'onchange',
      'postMethod': 'post',
      'form': 'tableform_' + this.id,
      'hightLight': '#ccffff',
      'emptyMsg': 'No records found',
      'primaryKey': '',
      'headings': [],
      'Itemid': 0,
      'formid': 0,
      'canEdit': true,
      'canView': true,
      'page': 'index.php',
      'rowTemplate': "",
      'groupTemplate': '',
			'headingTmpl':'',
      'data': [] //[{col:val, col:val},...]
    }, arguments[1] ||
    {});

   this.translate = Object.extend({
	 	'select_rows':'Select some rows for deletion',
		'confirm_drop':"Do you really want to delete all records and reset this tables key to 0?"
		}, arguments[2] || {});
		
		window.addEvent('domready', function(){
			this.getForm();
	    this.table = $('table_' + id);
	    if (this.table) {
	      this.tbody = this.table.getElementsByTagName('tbody')[0];
	    }
			this.watchAll();
		}.bind(this))
  },
	
	watchAll: function()
	{
		this.watchNav();
		this.watchRows();
		this.watchFilters();
		this.watchOrder();
		this.watchEmpty();
	},
	
	watchEmpty: function(e){
		var b = $E('input[name=doempty]', this.options.form);
		if (b) {
			b.addEvent('click', function(e){
				new Event(e).stop();
				if( confirm(this.translate.confirm_drop)){
					oPackage.submitfabrikTable(this.id,'doempty');
				}
			}.bind(this))
		}
	},
	
	watchOrder: function(){
		var hs = $(this.options.form).getElementsBySelector('.fabrikorder, .fabrikorder-asc, .fabrikorder-desc');
		hs.addEvent('click', function(event){
			var e = new Event(event);
			switch($(e.target).className){
				case 'fabrikorder-asc':
				var orderdir = 'desc';
				break;
				case 'fabrikorder-desc':
				var orderdir = "-";
				break;
				case 'fabrikorder':
				var orderdir = 'asc'
				break;
			}
			var td = $(e.target).getParent().className.replace('_heading', '');
			oPackage.fabrikNavOrder(this.id, td, orderdir);
			e.stop();
		}.bind(this))
	},
	
	watchFilters: function(){
		if (this.options.filterMethod != 'submitform') {
			$(this.options.form).getElements('.fabrik_filter').each(function(f){
				switch (f.getTag()) {
					case 'select':
						var e = 'change';
						break;
					default:
						var e = 'blur';
						break;
				}
				f.removeEvents();
				f.addEvent(e, function(){
					oPackage.submitfabrikTable(this.id, 'filter')
				}.bind(this))
			}.bind(this))
		}else{
			var f = $(this.options.form).getElement('.fabrik_filter_submit');
			if (f) {
				f.removeEvents();
				f.addEvent('click', function(e){
					if (this.options.postMethod == 'post') {
						$(this.options.form).submit();
					}
					else {
						oPackage.submitfabrikTable(this.id, 'filter')
					}
				}.bind(this))
			}
		}
	},
  
  //highlight active row, deselect others 
  setActive: function(activeTr){
    $A(this.table.getElementsByClassName('fabrik_row')).each(function(tr){
      tr.removeClass('activeRow');
    })
    activeTr.addClass('activeRow')
  },
  
  watchRows: function(){
    if(!this.table){
			return;
		}
		this.rows = $ES('.fabrik_row', this.table);
		this.links = this.table.getElements('.fabrik___rowlink');
    if (this.options.postMethod != 'post') {
      var view = '';
      if (this.options.canEdit == 1) {
        view = 'form';
      }
      else {
        if (this.options.canView == 1) {
          view = 'details';
        }
      }
      var opts = {
        option: 'com_fabrik',
        'Itemid': this.options.Itemid,
        'view': view,
        'tableid': this.id,
        'fabrik': this.options.formid,
        'rowid': 0,
        'format': 'raw',
        '_senderBlock': 'table_' + this.id
      };
      this.links.each(function(link){
        link.addEvent('click', function(e){
          var tr = link.findUp('tr');
					this.setActive(tr);
          oPackage.startLoading();
          opts.rowid = tr.id.replace('table_' + this.id + '_row_', '');
          var url = "index.php?" + Object.toQueryString(opts);
          var myAjax = new Ajax(url, {
            method: 'get',
            onComplete: function(res){
              oPackage.sendMessage('table_' + this.id, 'update', 'ok', res);
            }.bind(this)
          });
          myAjax.request();
          e = new Event(e);
          e.stop();
        }.bind(this));
      }.bind(this));
    }
  },
  
  getForm: function(){
		if (!this.form) {
			this.form = $(this.options.form);
		}
  },
  
  submitfabrikTable: function(task){
    this.getForm();
		if (task == 'delete') {
			var ok = false;
			this.form.getElements('input[name^=ids]').each(function(c){
				if(c.checked){
					ok = true;
				}
			});
			if(!ok){
				alert(this.translate.select_rows);
				return;
			}
			
		}
		if(task == 'resetFilters'){
			var filters = this.form.getElements('.fabrik_filter');
			(filters).each(function(f){
				if(f.getTag() == 'select'){
					f.selectedIndex = 0;
				}else{
					f.value = '';
				}
			})
			task = 'filter';
			mochaSearch.resetForm();
		}
    if (task == 'filter') {
      mochaSearch.getSQL();
      if (this.form.limitstart) {
        this.form.limitstart.value = 0;
      }
    }
    else {
      if (task != '') {
        this.form.task.value = task;
      }
    }
    if (this.options.postMethod == 'ajax') {
      $('table_' + this.id + '_format').value = 'raw';
      oPackage.startLoading();
      this.form.send({
        onComplete: function(json){
          oPackage.sendMessage('table_' + this.id, 'updateRows', 'ok', json);
        }.bind(this)
      })
    }
    else {
      this.form.submit();
    }
    return false;
  },
  
  fabrikNav: function(limitStart){
    this.form.limitstart.value = limitStart;
    this.submitfabrikTable('');
    return false;
  },
  
  fabrikNavOrder: function(orderby, orderdir){
		this.form.orderby.value = orderby;
    this.form.orderdir.value = orderdir;
    this.submitfabrikTable('viewTable');
    return false;
  },
  
  removeRows: function(rowids){
    //@TODO: try to do this with FX.Elements 
    for (i = 0; i < rowids.length; i++) {
      var row = $('table_' + this.id + '_row_' + rowids[i]);
      var highlight = new Fx.Styles(row, {
        duration: 1000
      });
      highlight.start({
        'backgroundColor': this.options.hightLight
      }).chain(function(){
        this.start({
          'opacity': 0
        })
      }).chain(function(){
        row.remove();
        this.checkEmpty();
      }.bind(this));
    }
  },
  
  editRow: function(){
  
  },
  
  clearRows: function(){
    this.rows.each(function(tr){
      tr.remove();
    });
  },
  
  updateRows: function(data){
    rowTmpl = this.options.rowTemplate;
    if (data.id == this.id) {
			this.clearRows();
      var tmpl = '';
      var headings = new Hash(data.headings);
			data = data.data;
			
			//add in the heading 
			
			var t = this.table.clone();
      t.id = 'templatetmp';
      t.injectInside(document.body);
      t.innerHTML = this.options.headingTmpl;
			
			headings.each(function(data, key){
				key = "." + key;
				if (t.getElement(key)) {
					t.getElement(key).setHTML(data);
				}
			});
			var newheading = $('templatetmp').getElement('.fabrik___heading'); 
			var oldheadings = this.table.getElements('.fabrik___heading');
			oldheadings.each(function(h){
				h.replaceWith(newheading);
			})
			var counter = 0;
			t.remove();
			//end heading
      data = new Hash(data);
      data.each(function(groupData, groupKey){
        groupData = new Hash(groupData);
        groupData.each(function(row, rowkey){
          row = new Hash(row);
          var pk = '';
          //create a temp element to inject values into
          //kinda presumes the teplate is a tr - not sure what happens if its a div for example
          var t = this.table.clone();
          t.id = 'templatetmp';
          t.injectInside(document.body);
					var thisrowtmpl = rowTmpl;
					thisrowtmpl = thisrowtmpl.replace('oddRow0', 'oddRow' + (counter % 2));
          t.innerHTML = thisrowtmpl;
          row.each(function(val, key){
            var rowk = '.fabrik_row___' + key;
            var cell = $('templatetmp').getElement(rowk);
            if (cell) {
              cell.setHTML(val);
            }
          }.bind(this));
          var r = t.innerHTML;
          r = r.replace('<tbody>', '');
          r = r.replace('</tbody>', '');
					var search = 'table_' + this.id + '_row_';
					var replace = search + row.get('__pk_val');
					r = r.replace(search, replace);
          tmpl += r;
          //remove the temp table template from the doc body
          t.remove();
					counter ++;
        }.bind(this));
      }.bind(this))
      this.tbody.innerHTML = this.tbody.innerHTML + tmpl;
      this.watchAll();
      //this.stripe();
    }
  },
  
  addRow: function(obj){
    /*var a = 0;
     for(var i in obj){
     a = a+ 1;
     }
     var c =  parseInt(this.options.headings.length) / parseInt(a);*/
    var r = new Element('tr', {
      'class': 'oddRow1'
    })
    var x = {
      test: 'hi'
    };
    for (var i in obj) {
      if (this.options.headings.indexOf(i) != -1) {
        var td = new Element('td', {}).appendText(obj[i]);
        //td.colSpan = c;
        r.appendChild(td);
      }
    }
    r.injectInside(this.tbody);
  },
  
  addRows: function(aData){
    for (i = 0; i < aData.length; i++) {
      for (j = 0; j < aData[i].length; j++) {
        this.addRow(aData[i][j]);
      }
    }
    this.stripe();
  },
  
  stripe: function(){
    var trs = $ES('.fabrik_row', this.table);
    for (i = 0; i < trs.length; i++) {
      if (i != 0) { //ignore heading
        var row = 'oddRow' + (i % 2);
        trs[i].addClass(row);
      }
    }
  },
  
  checkEmpty: function(){
    var trs = $ES('tr', this.table);
    if (trs.length == 2) {
      this.addRow({
        'label': this.options.emptyMsg
      });
    }
  },
  
  watchCheckAll: function(e){
    var checkAll = $('table_' + this.id + '_checkAll');
    if (checkAll) {
      checkAll.addEvent('change', function(e){
        var chkBoxes = $(this.options.form).getElements('input[name^=ids]'); //document.getElementsByName('ids[]');
				var c = !checkAll.checked ? '' : 'checked';
        for (var i = 0; i < chkBoxes.length; i++) {
          chkBoxes[i].checked = c;
        }
        var event = new Event(e);
        event.stop();
      }.bind(this));
    }
  },
  
  watchNav: function(e){
		var limitBox = this.form.getElement('select[name=limit]');
    if (limitBox) {
      limitBox.addEvent('change', function(e){
        oPackage.submitfabrikTable(this.id, '');
      }.bind(this));
    }
    var addRecord = $('table_' + this.id + '_addRecord');
    
    if ($(addRecord) && (this.options.postMethod != 'post')) {
      addRecord.addEvent('click', function(e){
        e = new Event(e);
        oPackage.startLoading();
        oPackage.sendMessage('table_' + this.id, 'clearForm', 'ok', '');
        e.stop();
      }.bind(this))
    }
		
		if($('fabrik__swaptable')){
			$('fabrik__swaptable').addEvent('change', function(event){
				var e = new Event(event);
				var v = e.target;
				window.location = 'index.php?option=com_fabrik&c=table&task=viewTable&cid=' + v.getValue();
			}.bind(this))
		}
    this.watchCheckAll();
		
		//clear filter list
		var c = this.form.getElement('.clearFilters');
		if(c){
			c.addEvent('click', function(e){
				oPackage.submitfabrikTable(this.id, 'resetFilters');
			}.bind(this))
		}
  },
  
  //todo: refractor addlistento into block class 
  addListenTo: function(blockId){
    this.listenTo.push(blockId);
  },
  
  receiveMessage: function(senderBlock, task, taskStatus, data){
    if (this.listenTo.indexOf(senderBlock) != -1) {
      switch (task) {
        case 'delete':
          this.removeRows(data);
          this.stripe();
          break;
        case 'processForm':
          this.addRows(data);
          break;
        case 'updateRows':
          this.updateRows(data);
          break;
      }
    }
  }
});
