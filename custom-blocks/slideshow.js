import { InnerBlocks } from "@wordpress/block-editor"

wp.blocks.registerBlockType("ageofqueenstheme/slideshow", {
    title: "AgeOfQueens-Slideshow",
    supports: {
        align: [ "full" ]
    },
    attributes: {
        align: { type: "string", default: "full" },
    },
    edit: EditComponent,
    save: SaveComponent
})

function EditComponent() {
    return (
        <div style={{ backgroundColor: "#333333", padding: "35px" }}>
            <p style={{ textAlign: "center", fontSize: "20px", color: "#ffffff" }}>Slideshow</p>
            <InnerBlocks allowedBlocks={[ "ageofqueenstheme/slide" ]}/>
        </div>
    )
}

function SaveComponent() {
    return <InnerBlocks.Content/>
}