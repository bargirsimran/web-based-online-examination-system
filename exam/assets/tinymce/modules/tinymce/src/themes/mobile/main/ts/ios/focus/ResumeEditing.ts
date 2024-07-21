/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import { Compare, Focus, SugarElement } from '@ephox/sugar';

import * as CursorRefresh from '../../touch/focus/CursorRefresh';

const resume = (cWin: Window, frame: SugarElement<HTMLElement>): void => {
  Focus.active().each((active) => {
    // INVESTIGATE: This predicate may not be required. The purpose of it is to ensure
    // that the content window's frame element is not unnecessarily blurred before giving
    // it focus.
    if (!Compare.eq(active, frame)) {
      Focus.blur(active);
    }
  });
  // Required when transferring from another input area.
  cWin.focus();

  Focus.focus(SugarElement.fromDom(cWin.document.body));
  CursorRefresh.refresh(cWin);
};

export {
  resume
};
