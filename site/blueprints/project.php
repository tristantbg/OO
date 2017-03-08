<?php if(!defined('KIRBY')) exit ?>

title: Project
files: true
pages: false
files:
  fields:
    backcolor:
      label: Background color
      type: color
      width: 1/2
    textcolor:
      label: Text color
      type: color
      width: 1/2
    caption:
      label: Caption
      type: textarea
fields:
  prevnext: prevnext
  title:
    label: Title
    type:  text
    validate:
      maxLength: 25
    width: 3/4
  date:
    label: Year
    type:  date
    format: YYYY
    width: 1/4
  backcolor:
      label: Background color
      type: color
      width: 1/3
  textcolor:
      label: Text color
      type: color
      width: 1/3
  featured:
    label: Featured image
    type: image
    width: 1/3
  text:
    label: Description
    type: textarea
  medias: 
    label: Images
    type: gallery