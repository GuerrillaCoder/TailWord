import { Controller } from "stimulus"

export default class extends Controller {
    greet() {
        console.log("Hello, Stimulus!", this.element);
        alert("Hi");
    }
}