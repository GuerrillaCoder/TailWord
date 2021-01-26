import React from "react";

import { Popup } from 'devextreme-react/ui/popup';
import * as overlay from 'devextreme/ui/overlay';
import { IconPicker } from "./icon-picker";


overlay.baseZIndex(9991);

interface IconButtonClick{
    settingNumber: number
}

export const IconPickerPopup: React.FunctionComponent<any> = (props) => {

    const [popupVisible, setPopupVisible] = React.useState(false);
    const [menuItemNumber, setMenuItemNumber] = React.useState(0);

    window.addEventListener('twicon', handleIconButtonClick);

    function handleIconButtonClick(e : CustomEvent<IconButtonClick>)
    {
        setMenuItemNumber(e.detail.settingNumber);
        setPopupVisible(true);
    }

    function handleWindowClose()
    {
        setPopupVisible(false);
        setMenuItemNumber(0);
    }


    return (
        <div className="tailwind icon-popup-wrapper">
            <Popup
                visible={popupVisible}
                onHiding={handleWindowClose}
                dragEnabled={false}
                closeOnOutsideClick={true}
                showTitle={true}
                title="Select an Icon"
                width="80vw"
                height="auto"
                
            >
                <IconPicker closeWindow={handleWindowClose} menuItemNumber={menuItemNumber} />

            </Popup>
        </div>
    )
}