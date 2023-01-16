import apiFetch from "@wordpress/api-fetch"
import {useEffect} from "@wordpress/element"
import {Button, PanelBody, PanelRow} from "@wordpress/components"
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck } from "@wordpress/block-editor"

wp.blocks.registerBlockType("ageofqueenstheme/banner", {
	title: "AgeOfQueens-Banner",
	supports: {
		align: ["full"]
	},
	attributes: {
		align: {type: "string", default: "full"},
		imgID: {type: "number"},
		imgURL: {type: "string", default: "/wp-content/themes/ageofqueenstheme/assets/images/placeholder.png"}
	},
	edit: EditComponent,
	save: SaveComponent
})

function EditComponent(props){

	useEffect(function(){
		async function go(){
			const res = await apiFetch({
				path: `/wp/v2/media/${props.attributes.imgID}`,
				method: 'GET'
			})
			console.log(res)
			props.setAttributes({imgURL: res.media_details.sizes.full.source_url})
		}
		go()
	}, [props.attributes.imgID])

	function onFileSelect(x){
		//console.log(x) // Shows us what it gives us in the console
		props.setAttributes({imgID: x.id})
	}

	return(
		<>
			<InspectorControls>
				<PanelBody title="Background" initialOpen={true}>
					<PanelRow>
						<MediaUploadCheck>
							<MediaUpload onSelect={onFileSelect} value={props.attributes.imgID} render={({ open })=>{
								return <Button onClick={open}>Choose Image</Button>
							}} />
						</MediaUploadCheck>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div className="page-banner">
				<div className="page-banner__bg-image" style={{backgroundImage: `url('${props.attributes.imgURL}')`}}>
				</div>
				<h1 className="headline headline--large d-none">Welcome!</h1>
				<div className="page-banner__content">
					<InnerBlocks allowedBlocks={["core/paragraph", "core/heading", "core/list", "ageofqueenstheme/heading", "ageofqueenstheme/button"]} />
				</div>
			</div>
		</>
	)
}

function SaveComponent(){
	return <InnerBlocks.Content/>
}