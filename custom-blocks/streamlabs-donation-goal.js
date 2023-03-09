import { TextControl, PanelBody, PanelRow} from "@wordpress/components"
import { InspectorControls } from "@wordpress/block-editor"

wp.blocks.registerBlockType("ageofqueenstheme/streamlabs-donation-goal", {
    title: "AgeOfQueens - Streamlabs Donation Goal",
    attributes: {
        token: { type: "string", default: "" },
        heading: { type: "string", default: "" },
    },
    edit: EditComponent,
    save: function () {
        return null
    }
})

function EditComponent(props) {

    return (
        <>
            <InspectorControls>
                <PanelBody title="Settings" initialOpen={true}>
                    <PanelRow>
                        <TextControl
                            label="Heading"
                            help="Enter the title."
                            value={props.attributes.heading}
                            onChange={(x) => props.setAttributes({ heading: x })}
                        />
                    </PanelRow>
                    <PanelRow>
                        <TextControl
                                label="Token"
                                help="Enter the token that is used by the API then."
                                value={props.attributes.token}
                                onChange={(x) => props.setAttributes({ token: x })}
                        />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <div className="placeholder-block">
                Streamlabs Donation Goal
            </div>
        </>
    )
}