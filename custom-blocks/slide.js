import apiFetch from "@wordpress/api-fetch"
import {useEffect, useState} from "@wordpress/element"
import {Button, PanelBody, PanelRow, CheckboxControl} from "@wordpress/components"
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck } from "@wordpress/block-editor"

wp.blocks.registerBlockType("ageofqueenstheme/slide", {
	title: "AgeOfQueens-Slide",
	supports: {
		align: ["full"]
	},
	attributes: {
		align: {type: "string", default: "full"},
		imgID: {type: "number"},
		imgURL: {type: "string", default: "/wp-content/themes/ageofqueenstheme/assets/images/placeholder.png"},
		isActive: {type: "boolean", default: false}
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
			props.setAttributes({imgURL: res.source_url})
		}
		go()
	}, [props.attributes.imgID])

	function onFileSelect(x){
		//console.log(x) // Shows us what it gives us in the console
		props.setAttributes({imgID: x.id})
	}

	function setActive(x){
		props.setAttributes({isActive: x})
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
				<PanelBody title="Slide Options">
					<PanelRow>
						<CheckboxControl label="Active slide" help="One slide needs to be active." checked={ props.attributes.isActive } onChange={ setActive } />
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div className="slide">
				<img className="slide__img" src={props.attributes.imgURL}>
				</img>
				<div className="slide__content">
					<InnerBlocks />
				</div>
			</div>
		</>
	)
}

function SaveComponent(){
	return <InnerBlocks.Content/>
}