wp.blocks.registerBlockType("ageofqueenstheme/members", {
	title: "AgeOfQueens - Members",
	edit: function(){
		return wp.element.createElement("div", { className: "placeholder-block"}, "Members Placeholder")
	},
	save: function () {
		return null
	}
})