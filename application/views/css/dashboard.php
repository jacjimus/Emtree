<style type="text/css">
    .dashboard-stat {
        position: relative;
        display: block;
        font-family: proxiManova-Light;
        padding:20px 10px;
        background-color: #eee;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        overflow: hidden;
}
.dashboard-stat,
.dashboard-stat:hover,
.dashboard-stat:active,
.dashboard-stat:focus {
        color: #666;
        text-decoration: none;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        outline: none;
}
.dashboard-stat i,
.dashboard-stat:hover i,
.dashboard-stat:active i,
.dashboard-stat:focus i {
        color: #e4e4e4;
}
.dashboard-stat:hover {
        background-color: #e6e6e6;
}
.dashboard-stat:hover i {
        color: #dcdcdc;
}
.dashboard-stat:active {
        outline: 0;
        -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        -moz-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.dashboard-stat.primary,
.dashboard-stat.primary:hover,
.dashboard-stat.primary:active {
        color: #FFF;
        background-color: #e5412d;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}
.dashboard-stat.primary i,
.dashboard-stat.primary:hover i,
.dashboard-stat.primary:active i {
        color: #dd301b;
}
.dashboard-stat.primary:hover {
        background-color: #e3351f;
}
.dashboard-stat.primary:hover i {
        color: #d42e1a;
}
.dashboard-stat.secondary,
.dashboard-stat.secondary:hover,
.dashboard-stat.secondary:active {
        color: #FFF;
        background-color: #f0ad4e;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}
.dashboard-stat.secondary i,
.dashboard-stat.secondary:hover i,
.dashboard-stat.secondary:active i {
        color: #eea236;
}
.dashboard-stat.secondary:hover {
        background-color: #eea236;
}
.dashboard-stat.secondary:hover i {
        color: #ec9924;
}
.dashboard-stat.tertiary,
.dashboard-stat.tertiary:hover,
.dashboard-stat.tertiary:active {
        color: #FFF;
        background-color: #888888;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}
.dashboard-stat.tertiary i,
.dashboard-stat.tertiary:hover i,
.dashboard-stat.tertiary:active i {
        color: #7b7b7b;
}
.dashboard-stat.tertiary:hover {
        background-color: #7b7b7b;
}
.dashboard-stat.tertiary:hover i {
        color: #717171;
}
.dashboard-stat .visual {
        z-index: 10;
        float: right;
        width: 54px;
        height: 100%;
}
.dashboard-stat .details {
        position: relative;
        z-index: 11;
        float: left;
        margin-top: -10px;
        text-align: left;
}
.dashboard-stat .value {
        display: block;
        /*font-size: 32px;*/
        font-size: 18px;
        font-weight: 600;
}
.dashboard-stat .content {
        display: block;
        /*margin-bottom: 1em;*/
        /*font-size: 13px;*/
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
}
.dashboard-stat .visual i {
        position: absolute;
        left: 0;
        left: auto;
        right: 0;
        bottom: 0;
        display: block;
        height: 72px;
        font-size: 72px;
        -webkit-transform: rotate(-30deg);
        -moz-transform: rotate(-30deg);
        -o-transform: rotate(-30deg);
        -ms-transform: rotate(-30deg);
        transform: rotate(-30deg);
        text-shadow: none;
}
.dashboard-stat .more {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 16px;
        color: rgba(0, 0, 0, 0.25) !important;
        text-shadow: none;
}
.timeline_divs{
    width: 600px; height: auto;
    padding: 10px; border-bottom: 1px gainsboro dotted;}
.logo {font-size: 36px; padding: 40px; margin-left: 50px;font-family: LOGO}
@font-face {
	font-family: LOGO;
	src: url("fonts/fontomas-webfont.svg");
    src: local('â˜º'), url('../fonts/fontomas-webfont.woff') format('woff'), url('../fonts/fontomas-webfont.ttf') format('truetype'), url('../fonts/fontomas-webfont.svg') format('svg');
    font-weight: normal; font-style: normal;

}
</style>