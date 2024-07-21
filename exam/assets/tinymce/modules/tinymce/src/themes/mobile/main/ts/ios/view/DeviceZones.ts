/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import { Css, Height, SugarElement, Traverse } from '@ephox/sugar';

import * as Orientation from '../../touch/view/Orientation';
import * as Devices from './Devices';

type Keyboard = Devices.Keyboard;

// Green zone is the area below the toolbar and above the keyboard, its considered the viewable
// region that is not obstructed by the keyboard. If the keyboard is down, then the Green Zone is larger.

/*
    _______________________
    |        toolbar      |
    |_____________________|
    |                     |
    |                     |
    |       greenzone     |
    |_____________________|
    |                     |
    |       keyboard      |
    |_____________________|

*/

const softKeyboardLimits = (outerWindow): Keyboard =>
  Devices.findDevice(outerWindow.screen.width, outerWindow.screen.height);

const accountableKeyboardHeight = (outerWindow: Window): number => {
  const portrait = Orientation.get(outerWindow).isPortrait();
  const limits = softKeyboardLimits(outerWindow);

  const keyboard = portrait ? limits.portrait : limits.landscape;

  const visualScreenHeight = portrait ? outerWindow.screen.height : outerWindow.screen.width;

  // This is our attempt to detect when we are in a webview. If the DOM window height is smaller than the
  // actual screen height by about the size of a keyboard, we assume that's because a keyboard is
  // causing it to be that small. We will improve this at a later date.
  return (visualScreenHeight - outerWindow.innerHeight) > keyboard ? 0 : keyboard;
};

const getGreenzone = (socket: SugarElement<HTMLElement>, dropup: SugarElement<HTMLElement>): number => {
  const outerWindow = Traverse.owner(socket).dom.defaultView;
  // Include the dropup for this calculation because it represents the total viewable height.
  const viewportHeight = Height.get(socket) + Height.get(dropup);
  const acc = accountableKeyboardHeight(outerWindow);
  return viewportHeight - acc;
};

const updatePadding = (contentBody: SugarElement<Node>, socket: SugarElement<HTMLElement>, dropup: SugarElement<HTMLElement>): void => {
  const greenzoneHeight = getGreenzone(socket, dropup);
  const deltaHeight = (Height.get(socket) + Height.get(dropup)) - greenzoneHeight;
  // TBIO-3878 Changed the element that was receiving the padding from the iframe to the body of the
  // iframe's document. The reasoning for this is that the syncHeight function of IosSetup.js relies on
  // the scrollHeight of the body to set the height of the iframe itself. If we don't set the
  // padding-bottom on the body, the scrollHeight is too short, effectively disappearing the content from view.
  Css.set(contentBody, 'padding-bottom', deltaHeight + 'px');
};

export {
  getGreenzone,
  updatePadding
};
