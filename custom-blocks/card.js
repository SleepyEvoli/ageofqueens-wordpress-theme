import { Button, PanelBody, PanelRow, ColorPicker} from "@wordpress/components"
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, BlockControls, __experimentalLinkControl as LinkControl } from "@wordpress/block-editor"

wp.blocks.registerBlockType("ageofqueenstheme/card", {
	title: "AgeOfQueens-Card",
	attributes: {
		imgURL: {type: "string", default: "/wp-content/themes/ageofqueenstheme/assets/images/placeholder.png"},
		backgroundColor: {type: "string", default: "#A9B1E417"},
		linkUrl: {type: "string", default: "/"},
		linkObject: {type: "object"}
	},
	edit: EditComponent,
	save: SaveComponent
})

function EditComponent(props){

	function onFileSelect(x){
		props.setAttributes({imgURL: x.url})
	}


	function setColor(x){
		props.setAttributes({backgroundColor: x})
	}

	const cardEditorStyle = {
		padding: "1rem",
		backgroundColor: props.attributes.backgroundColor,
		borderRadius: "10px",
		maxWidth: "430px",
		marginTop: "1rem"
	}

	function setLink(x){
		props.setAttributes({linkUrl: x.url})
		props.setAttributes({linkObject: x})
	}

	return(
		<>
			<BlockControls>
				<LinkControl onChange={setLink} value={props.attributes.linkObject}/>
			</BlockControls>
			<InspectorControls>
				<PanelBody title="Card Image" initialOpen={true}>
					<PanelRow>
						<MediaUploadCheck>
							<MediaUpload onSelect={onFileSelect} render={({ open })=>{
								return <Button onClick={open}>Choose Image</Button>
							}} />
						</MediaUploadCheck>
					</PanelRow>
				</PanelBody>
				<PanelBody title="Background Color" initialOpen={true}>
					<PanelRow>
						<ColorPicker color={props.attributes.backgroundColor} onChange={setColor} enableAlpha defaultValue="#A9B1E417"/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>

			<div style={cardEditorStyle}>
				<img className="custom-block__card__img" src={props.attributes.imgURL} alt="editor custom-block card"></img>
				<div className="custom-block__card__content"><InnerBlocks /></div>
			</div>
		</>
	)
}

function SaveComponent(){
	return <InnerBlocks.Content/>
}