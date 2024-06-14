wp.blocks.registerBlockType("ageofqueenstheme/twitter-timeline", {
    title: "AgeOfQueens - Twitter-Timeline",
    supports: {
        align: true
    },
    edit: function(){
        return wp.element.createElement("div", { className: "placeholder-block"}, "Twitter-Timeline Placeholder")
    },
    save: function () {
        return null
    }
})