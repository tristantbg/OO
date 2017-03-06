<?php if(!defined('KIRBY')) exit ?>

title: Site
fields:
  introSettings:
    label: Intro Settings
    type: headline
  introtitle:
    label: Intro text
    type:  text
  introbackground:
    label: Intro background
    type:  color
    width: 1/3
  introtextcolor:
    label: Intro text color
    type:  color
    width: 1/3
  introtextsize:
    label: Intro text size
    type:  number
    min: 2
    max: 10
    default: 6
    step: .1
    width: 1/3
  generalSettings:
    label: Site Settings
    type: headline
  title:
    label: Title
    type:  text
  description:
    label: Description
    type:  textarea
  keywords:
    label: Keywords
    type:  tags
  customcss:
    label: Custom CSS
    type: textarea
    buttons: false
  googleAnalytics:
    label: Google Analytics ID
    type: text
    icon: code
    help: Tracking ID in the form UA-XXXXXXXX-X. Keep this field empty if you are not using it.
    width: 1/2
  ogimage:
    label: Facebook OpenGraph image
    type: image
    help: 1200x630px minimum
    width: 1/2