window.addEventListener("gamepadconnected", (e) => {
  console.log("Gamepad conectado:", e.gamepad);
  startGamepadLoop();
});

function startGamepadLoop() {
  function update() {
    const gamepads = navigator.getGamepads();
    if (!gamepads) return;

    const gp = gamepads[0]; // Primer gamepad conectado
    if (gp && window.jsnesInstance) {
      const nes = window.jsnesInstance;

      // Mapeo de botones Xbox → jsnes
      const mapping = [
        { index: 0, nesBtn: nes.Controller.BUTTON_A },       // A
        { index: 1, nesBtn: nes.Controller.BUTTON_B },       // B
        { index: 8, nesBtn: nes.Controller.BUTTON_SELECT },  // Select / Back
        { index: 9, nesBtn: nes.Controller.BUTTON_START },   // Start
        { index: 12, nesBtn: nes.Controller.BUTTON_UP },     // D-Pad Up
        { index: 13, nesBtn: nes.Controller.BUTTON_DOWN },   // D-Pad Down
        { index: 14, nesBtn: nes.Controller.BUTTON_LEFT },   // D-Pad Left
        { index: 15, nesBtn: nes.Controller.BUTTON_RIGHT }   // D-Pad Right
      ];

      for (const btn of mapping) {
        if (gp.buttons[btn.index].pressed) {
          nes.buttonDown(1, btn.nesBtn);
        } else {
          nes.buttonUp(1, btn.nesBtn);
        }
      }
    }

    requestAnimationFrame(update);
  }

  requestAnimationFrame(update);
}
