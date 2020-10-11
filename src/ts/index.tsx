import { Application } from "stimulus"
import { definitionsFromContext } from "stimulus/webpack-helpers"
import 'alpinejs'
import React from "react";
import ReactDOM from "react-dom";
import { IconPicker } from './components/icon-picker';
import { IconPickerPopup } from "./components/icon-picker-popup";

const application = Application.start();
const context = require.context("./controllers", true, /\.ts$/);
application.load(definitionsFromContext(context));

var root = document.getElementById("root");

if (root) {
    ReactDOM.render(<Hello />, root);
}

function Hello() {
    return (
        <div>
        <h1>Hello, world! </h1> <UpdateButton />
        </div>
    );
}

function UpdateButton() {

    function updateValue(e : React.MouseEvent){
        (document.getElementById("outside") as HTMLInputElement).value = "yo";
    }

    return (<button onClick={updateValue}> Click Me </button>);
}

const iconPickerElement = document.getElementById("tw-icon-picker");
if (iconPickerElement) {

    ReactDOM.render(
        <IconPickerPopup />,
        iconPickerElement
    );

}