wp.blocks.registerBlockType("ageofqueenstheme/mods", {
	title: "AgeOfQueens - Mods",
	edit: function(){
		return wp.element.createElement("div", { className: "placeholder-block"}, "Mods Placeholder")
	},
	save: function () {
		return null
	}
})