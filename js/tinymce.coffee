(($)->
	$ ->
		tinymce.create 'tinymce.plugins.Code',
			init: (ed,url)->
				ed.addButton 'wp-prism-hl-code',
					title: "Code"
					cmd: "code"
					icon: 'code'
				ed.addShortcut 'alt+c', 'Insert [code] shortcode.', 'code'
				ed.addCommand 'code', ->
						if sel_text = ed.selection.getContent()
							text = '[code]' + sel_text + '[/code]'
						else 
							text = '[code][/code]'
						ed.execCommand('mceInsertContent',0,text)
			getInfo: ->
				[
					longname: "WordPress Prism Highlighter"
					author: "Dmitriy Belyaev"
					authorurl: "http://codemotion.ru"
					infourl: "http://codemotion.ru"
					version: "1.0"
				]		
		tinymce.PluginManager.add('code',tinymce.plugins.Code)

) jQuery