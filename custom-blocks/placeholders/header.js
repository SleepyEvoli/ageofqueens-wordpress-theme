wp.blocks.registerBlockType("ageofqueenstheme/header", {
	title: "AgeOfQueens - Header",
	edit: function(){
		return wp.element.createElement("div", { className: "placeholder-block"}, "Header Placeholder")
	},
	save: function () {
		return null
	}
})