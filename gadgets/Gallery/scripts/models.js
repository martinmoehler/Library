
//--- Models ---//


var galleryChooser;

galleryChooser = {};
galleryChooser.Preview = {};

galleryChooser.Preview.Small = Small = Model.create();
Small.extend({
    imgWidth: "60",
    liHeight: "80px",
    liWidth: "70px",
    titleWidth: "40px",
    titleBottom: "35px",
    titleLeft: "9px",
    titleBackColor: 'rgba(210,210,210,.7)',
    firstImgLeft: "10px",
    firstImgTop: "8px",
    firstImgWidth: "40px"
});

galleryChooser.Preview.Medium = Medium = Model.create();
Medium.extend({
    imgWidth: "80",
    liHeight: "100px",
    liWidth: "90px",
    titleWidth: "50px",
    titleBottom: "35px",
    titleLeft: "14px",
    titleBackColor: 'rgba(210,210,210,.7)',
    firstImgLeft: "15px",
    firstImgTop: "11px",
    firstImgWidth: "50px"
});

galleryChooser.Preview.Big = Big = Model.create();
Big.extend({
    imgWidth: "110",
    liHeight: "120px",
    liWidth: "110px",
    titleWidth: "70px",
    titleBottom: "35px",
    titleLeft: "19px",
    titleBackColor: 'rgba(210,210,210,.7)',
    firstImgLeft: "20px",
    firstImgTop: "15px",
    firstImgWidth: "70px"
});

galleryChooser.InfoBox = {};
galleryChooser.InfoBox.Lang = {};

galleryChooser.InfoBox.Show = Show = Model.create();
Show.extend({
    copyright: true,
    description: true,
    fileName: true,
    fullImg: false,
    gallery: false,
    id: false,
    index: false,
    persons: true,
    photographer: true,
    thmbImg: false,
    title: true
});

galleryChooser.InfoBox.Lang.DE = DE = Model.create();
DE.extend({
    copyright: "Copyright",
    description: "Beschreibung",
    fileName: "File-Name",
    persons: "Personen",
    title: "Titel",
    photographer: "Fotograf"
});

galleryChooser.InfoBox.Lang.EN = EN = Model.create();
EN.extend({
    copyright: "Copyright",
    description: "Description",
    fileName: "Filename",
    persons: "Persons",
    title: "Title",
    photographer: "Photographer"
});

galleryChooser.CSS = CSS = Model.create();
CSS.extend({
    closedRight: -1, 
    closedWidth: -1,
    openedWidth: -1,
    paddingTop: 0,
    paddingLeft: 0,
    paddingRight: 0,
    paddingBottom: 0
});