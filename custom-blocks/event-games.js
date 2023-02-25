import { TextControl, PanelBody, PanelRow} from "@wordpress/components"
import { InspectorControls } from "@wordpress/block-editor"

wp.blocks.registerBlockType("ageofqueenstheme/event-games", {
    title: "AgeOfQueens - Event Games",
    attributes: {
        eventName: { type: "string", default: "" },
    },
    edit: EditComponent,
    save: function () {
        return null
    }
})

function EditComponent(props){
    return (
        <>
            <InspectorControls>
                <PanelBody title="Settings" initialOpen={true}>
                    <PanelRow>
                        <TextControl
                            label="Event Name"
                            help="Enter the event name with dashes + the league. Example: Queen's Clash Gold League -> queens-clash-gold-league"
                            value={props.attributes.eventName}
                            onChange={(x) => props.setAttributes({ eventName: x })}
                        />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <div>
                Event Games
            </div>
        </>
    )
}
