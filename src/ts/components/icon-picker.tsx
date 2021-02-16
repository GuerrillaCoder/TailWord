import React from "react";
import * as _ from "lodash";
import * as Icons from '../icons/index'
import TextBox from 'devextreme-react/text-box';
import Highlighter from "react-highlight-words";
import {renderToString} from 'react-dom/server'
import jQuery from 'jquery';

declare global {
    interface Window {
        lodash: typeof _;
    }
}

window.lodash = _.noConflict();

declare global {
    interface Window {
        jQuery: typeof jQuery;
    }
}


export class IconOption {
    source: string;
    name: string;
    Component: React.FunctionComponent<React.SVGProps<SVGSVGElement>>
}

// interface IconSource {
//     sourceName : string;
//     module : Module
// }

export interface IconPickerProps {
    menuItemNumber: number;
    svgProps?: React.SVGProps<SVGSVGElement>;
    closeWindow: CallableFunction;


}

export const IconPicker: React.FunctionComponent<IconPickerProps> = (props) => {


    let iconKeys = Object.values(Icons.IconOutline);
    let entries = Object.entries(Icons.IconOutline);

    let iconObjects = [
        {
            sourceName: "Hero Icons Outline",
            module: Icons.IconOutline
        },
        {
            sourceName: "Hero Icons Solid",
            module: Icons.IconSolid
        }];

    let iconOptions: IconOption[] = [];

    iconObjects.forEach(x => {
        Object.entries(x.module).forEach(iconImport => {
            let iconOption = new IconOption();
            iconOption.source = x.sourceName;
            iconOption.name = getReadableName(iconImport[0]);
            iconOption.Component = iconImport[1];
            iconOptions.push(iconOption);
        });

    });

    iconOptions = _.sortBy(iconOptions, [(o) => o.name]);

    const [filteredIcons, setIcons] = React.useState(iconOptions);

    const [searchTerm, setSearchTerm] = React.useState("");


    function getReadableName(name: string): string {
        var result = name.replace(/([A-Z])/g, " $1");
        var finalResult = result.charAt(0).toUpperCase() + result.slice(1);

        return finalResult;
    }

    function getHighlightedText(text: string, highlight: string) {
        // Split text on highlight term, include term itself into parts, ignore case
        const parts = text.split(new RegExp(`(${highlight})`, 'gi'));
        return <span>{parts.map(part => part.toLowerCase() === highlight.toLowerCase() ? <b>{part}</b> : part)}</span>;
    }

    let gridUpdateTimer: NodeJS.Timeout;

    async function updateGrid(event: any) {

        clearTimeout(gridUpdateTimer);
        gridUpdateTimer = setTimeout(() => {

            setSearchTerm(event.event.target.value.toLowerCase());
            //setIcons(_.filter(iconOptions, (o) =>  o.name.toLowerCase().includes(event.value.toLowerCase())));
            setIcons(_.filter(iconOptions, (o) => o.name.toLowerCase().includes(event.event.target.value.toLowerCase())));
        }, 500);
    }

    function setIconValue(iconOption: IconOption) {
        // let sourceInput = window.jQuery(`#menu-item-${props.menuItemNumber} div[data-name=source] input`);
        // let iconImage = window.jQuery(`#menu-item-${props.menuItemNumber} .icon-select-row .icon`);

        let sourceInput : HTMLInputElement = document.querySelector(`#menu-item-${props.menuItemNumber} div[data-name=source] input`);
        let iconImage = document.querySelector(`#menu-item-${props.menuItemNumber} .icon-select-row .icon`);

            let svgCode = renderToString(<iconOption.Component/>);

        // sourceInput.val(svgCode);
        // sourceInput.trigger("change");

        sourceInput.value = svgCode;
        sourceInput.dispatchEvent(new Event("change"));

        let icon = sourceInput.closest(".menu-item-settings").querySelector(".icon-select-row .icon");
        icon.innerHTML = svgCode;
        // iconImage.html(svgCode);

        props.closeWindow();
    }

    return (
        <div className="tw-min-h-full tailwind">
            <div className="tw-p-4">
                <TextBox onInput={updateGrid} placeholder="Search icons..."/>
            </div>

            <div className="icon-picker ">
                {
                    filteredIcons.map(
                        iconOption => (
                            <div key={iconOption.source + '-' + iconOption.name}
                                 onClick={() => setIconValue(iconOption)}
                                 className="icon-selection tw-inline-block tw-rounded tw-overflow-hidden tw-shadow-lg tw-bg-white tw-m-1 hover:tw-bg-blue-100 tw-cursor-pointer">
                                <div className="icon-wrapper tw-px-2 tw-py-2 tw-text-center">


                                    <iconOption.Component {...props.svgProps} />
                                    <div className="text-wrapper">
                                        {/* <div className="icon-text">{iconOption.name}</div>
                                        <div className="icon-text">{getHighlightedText(iconOption.name, searchTerm)}</div> */}
                                        <Highlighter
                                            className="icon-text"
                                            highlightClassName="tw-bg-yellow-200"
                                            searchWords={[searchTerm]}
                                            autoEscape={true}
                                            textToHighlight={iconOption.name}
                                        />
                                    </div>


                                </div>
                            </div>
                        )
                    )
                }
            </div>
        </div>
    );
}


