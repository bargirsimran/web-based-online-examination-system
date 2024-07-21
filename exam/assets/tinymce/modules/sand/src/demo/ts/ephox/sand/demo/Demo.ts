import * as PlatformDetection from 'ephox/sand/api/PlatformDetection';

const platform = PlatformDetection.detect();

const ephoxUi = document.querySelector('#ephox-ui');
ephoxUi.innerHTML = 'You are using: ' + platform.browser.current;
