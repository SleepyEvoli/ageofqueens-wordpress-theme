wp.blocks.registerBlockType("ageofqueenstheme/footer", {
	title: "AgeOfQueens - Footer",
	edit: function(){
		return wp.element.createElement("div", { className: "placeholder-block"}, "Footer Placeholder")
	},
	save: function () {
		return null
	}
})