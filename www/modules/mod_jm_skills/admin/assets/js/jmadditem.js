jQ = jQuery.noConflict();
var JM=JM||{};
(function(){
    JM.ItemList = new Class({
        Implements:[Options,Events],
        options:{},
        initialize:function(options){
            
            this.setOptions(options);
            var items = JSON.decode(new JM.Base64().base64Decode(this.options.encodedItems));
            var self=this;
            this.sortables=new Sortables(this.options.container,{
                clone:true,
                revert:true,
                opacity:0.3,
                onStart:function(element, clone){
                    clone.setStyle("z-index",999)
                }
            });
            if(items!=null){
                items.each(function(item){
                    self.add(item)
                })
            }
            var submit =null;
            if(typeof document.adminForm.onsubmit=="function"){
                submit = document.adminForm.onsubmit
            }
            document.adminForm.onsubmit=function(){
                var items=[];
                var i=0;
                $$("#btg-items-container li").each(function(li){
                    var item=li.retrieve("data");
                    if(item!=null){
                        items[i]=item;
                        i++
                    }
                });
                $("btg-hidden").set("value",new JM.Base64().base64Encode(JSON.encode(items)));
                if(submit!=null){
                    submit()
                }
            }
        },
        /**
         * This method will show form to create item or update item
         * 
         * */
        
        openDialog: function(edit, li, item){
            var self = this;
            var dialog = new Element('<div>', {
                id: "btg-dialog", 
                html: this.options.dialogTemplate
            })
           if(jQ("#btg-dialog").length >0){
        	   jQ('#btg-dialog').remove();
           }
            jQ("#item-form").append(dialog);
            
            //bind event for cancel
            jQ(self.options.btnCancelID).bind('click', function(){
            	 jQ('#btg-dialog').remove();
            	 jQ("#btnAddItem").removeAttr("disabled");
            	 jQ("#btnAddItem").removeClass("disable-btn");
                return false; 
            });
           
            if(!edit){
                jQ(self.options.btnCreateID).show();
                jQ(self.options.btnUpdateID).hide();
                jQ(self.options.btnCreateID).unbind('click').bind('click', function(){
                    jQ('#btg-messages').html('');
                    //create item
                    var msg = '';
                    var item = new Object();
                    item.itemTitle = jQ('#btg-item-title').val();
                    item.itemPercent = jQ('#btg-item-percent').val();
                    
                    if(item.itemTitle == ''){
                        msg= 'Please enter title of item';
                    }
                    if(msg != ''){
                        alert(msg);
                        return false;
                    }
                    self.add(item);
                    //khoi tao lai form
                    jQ('#btg-messages').html('').append(jQ('<div>').addClass('JM-message success').html(self.options.warningText.addItemSuccess));
					jQ('#btg-dialog').remove();
                	jQ("#btnAddItem").removeAttr("disabled");
                	jQ("#btnAddItem").removeClass("disable-btn");
                    return false;
                });
            }else{
                if(item == null){
                	 jQ("#btnAddItem").removeAttr("disabled");
                	 jQ("#btnAddItem").removeClass("disable-btn");
                    return false
                }
                scrolltoTop = jQ("#btnAddItem").offset().top ;
                jQ('html,body').animate({scrollTop: scrolltoTop},'fast');
				
                jQ(self.options.btnUpdateID).show();
                jQ(self.options.btnCreateID).hide();
                jQ(self.options.btnUpdateID).unbind('click');
                jQ('#btg-item-title').val(item.itemTitle);
                jQ('#btg-item-percent').val(item.itemPercent);
                jQ(self.options.btnUpdateID).click(function(){
                    self.update(li, item);
                    return false;
                });
            }
            $$('#item-form .bt_switch').each(function(el)
                    {
                        var options = el.getElements('option');		
                        if(options.length==2){
                            el.setStyle('display','none');
                            var value = new Array();
                            value[0] = options[0].value;
                            value[1] = options[1].value;
        		
                            var text = new Array();
                            text[0] = options[0].text.replace(" ","-").toLowerCase().trim();
                            text[1] = options[1].text.replace(" ","-").toLowerCase().trim();
        		
                            var switchClass = (el.value == value[0]) ? text[0] : text[1];
        	
                            var switcher = new Element('div',{
                                'class' : 'switcher-'+switchClass
                            });

                            switcher.inject(el, 'after');
                            switcher.addEvent("click", function(){
                                if(el.value == value[1]){
                                    switcher.setProperty('class','switcher-'+text[0]);
                                    el.value = value[0];
                    
                                } else {
                                    switcher.setProperty('class','switcher-'+text[1]);
                                    el.value = value[1];
                                }
                            });
                        }
                    });
            //End code show/hid, bind event,
            return false;
        },
        add:function(item){
            var liHTML = '<div class="div-item">'
			+ 	'<div class="item_title item-title-label">'
            + 		'<span class="label">Title : </span>'
            +		'<span class="value">'+item.itemTitle+'</span>'
            + 	'</div>'
            +	'<div class="item_percent item-title-label-hide">'
            +		'<span class="label">Percent : </span>'
            +		'<span class="value">'+item.itemPercent +'</span>' 
            +	'</div>' 
            +	'</div>'
            +	'<div class="edit-remove-link"><a href="javascript:void(0)" class="edit">Edit</a><a href="javascript:void(0)" class="remove">Remove</a><div class="clear"></div></div>';
            var li = new Element("li",{
                'class' : 'item-display',
                html: liHTML
            });
            var self=this;
            li.getElement(".edit").addEvent("click",function(){
                self.edit(li);
			});
            li.getElement(".remove").addEvent("click",function(){
                self.remove(li)
            });
            
            li.store("data",item);
            var container=$(this.options.container);
            li.set("opacity",0);
            container.grab(li);
            li.fade("in");
            this.sortables.addItems(li);
        },
        edit:function(li){
            var item = li.retrieve("data");
            if(item!= null){
                this.openDialog(true, li, item);
                
            }
			jQ('#btg-dialog select.jm-field').jmSelectSingle();
        },
        update: function(li, item){
            var msg = '';
            var title = jQ('#btg-item-title').val();
            var percent = jQ('#btg-item-percent').val();
            if(title == ''){
                msg = "Please enter title of item";
            }
            if(msg != ''){
                alert(msg);
                return false;
            }
            //updateItem
            item.itemTitle = title;
            item.itemPercent = percent;
            li.store('data', item);
            //update li
            jQ(li).find('.item_title .value').html(title);
            jQ(li).find('.item_percent .value').html(percent);
       
            jQ('#btg-messages').html('').append(jQ('<div>').addClass('JM-message success').html(this.options.warningText.updateMarkerSuccess));
	
	    	jQ('#btg-dialog').remove();
	        jQ("#btnAddItem").removeAttr("disabled");
	        jQ("#btnAddItem").removeClass("disable-btn");
                  
            return false;
            
        },
        remove:function(li){
            if(confirm(this.options.warningText.confirmDelete)){
                var b=new Fx.Morph(li);
                b.start({
                    height:0,
                    opacity:0
                }).chain(function(){
                    li.dispose()
                });
            }
        },
        removeAll: function(){
            if(confirm(this.options.warningText.confirmDeleteAll)){
                var a = $(this.options.container);
                var b = a.getElements("li");
                b.each(function(c){
                    var d=new Fx.Morph(c);
                    d.start({
                        width:0,
                        height:0,
                        opacity:0
                    }).chain(function(){
                        c.dispose()
                    });
                });
                jQ('#btg-optional-container').show();
                setTimeout(function(){
                    jQ('#btg-optional-container').slideUp(500)
                }, 1500);
            }
            return false;
        },
        showMessage:function(messageText){
            
            var messageContainer = $(this.options.messageContainer);
            var message = new Element("div", {
                'class': 'JM-message'
            });
            message.set("html",messageText);
            message.set("opacity",0);
            messageContainer.grab(message,"top");
            var b=new Fx.Morph(message,{
                link:"chain"
            });
            b.start({
                opacity:1,
                visibility:'visible'
            });
            this.removeLog();
        },
        removeLog:function(){
            $(this.options.messageContainer).getElements("div.JM-message").each(function(d,b,c){
                setTimeout(function(){
                    var e=new Fx.Morph(d,{
                        link:"chain"
                    });
                    e.start({
                        height:0,
                        opacity:0
                    }).chain(function(){
                        d.dispose()
                    })
                },1000)
            })
        },
        htmlEntities: function(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }       
    })
})();