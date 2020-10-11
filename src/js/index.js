import "../css/style.css";
import { Application } from "stimulus"
import { definitionsFromContext } from "stimulus/webpack-helpers"
import 'alpinejs'

const application = Application.start();
const context = require.context("./controllers", true, /\.js$/);
application.load(definitionsFromContext(context));


