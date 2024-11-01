(function() {
	tinymce.create('tinymce.plugins.addsrc', {
		init : function(ed, url) {
			ed.addButton('addsrc', {
				title : 'Add Sourcecode Tags',
				image : url+'/button-icon.png',
				onclick : function() {
					var sclang = prompt("Sourcecode language:", "HTML");
					if (sclang!="null" && sclang!="undefined" && sclang!="") {
						sclang = sclang.replace(/ /g,'');
						sclang = sclang.toLowerCase();
						ed.selection.setContent('[sourcecode language="' + sclang + '"]' + ed.selection.getContent() + '[/sourcecode]');
					}
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('addsrc', tinymce.plugins.addsrc);
})();