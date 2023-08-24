const hotKeys = [];
const hotkeys = (event) => {
  let key = event.key;
  if (['Control', 'Shift', "Meta"].includes(key)) return false;
  if (event.ctrlKey) key = 'ctr+' + key;
  if (event.shiftKey) key = 'shift+' + key;
  if (event.metaKey) key = 'meta+' + key;
  hotKeys.forEach(
    (el) => {
      if (el.keys.map((k) => k.toString()).includes(key)) {
        el.callback(event);
      }
    }
  );
};

document.addEventListener('keydown', hotkeys);