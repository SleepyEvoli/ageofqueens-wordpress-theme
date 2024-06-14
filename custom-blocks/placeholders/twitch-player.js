wp.blocks.registerBlockType("ageofqueenstheme/twitch-player", {
    title: "AgeOfQueens - Twitch-Player",
    supports: {
        align: true
    },
    edit: function(){
        return wp.element.createElement("div", { className: "placeholder-block"}, "Twitch-Player Placeholder")
    },
    save: function () {
        return null
    }
})