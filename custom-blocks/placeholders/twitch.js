wp.blocks.registerBlockType("ageofqueenstheme/twitch", {
	title: "AgeOfQueens - Twitch",
	edit: function(){
		return wp.element.createElement("div", { className: "placeholder-block"}, "Twitch Placeholder")
	},
	save: function () {
		return null
	}
})