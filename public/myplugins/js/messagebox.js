class MessageBox {

  constructor(msg) {
    this.build(msg);
  }

  build(msg) {
    let messageBox  = $('<div></div>').addClass('messagebox');
    let content     = $('<div></div>').addClass('messagebox-content text-center');
    let message = $('<p></p>').text(msg);
    let footer      = $('<div></div>').addClass('messagebox-footer text-center');
    let closeButton = $('<button></button>').addClass('close-messagebox-button js-close-messagebox-button');
    closeButton.text('Đóng');
    closeButton.click(function(event) {
      toggleOverlayHidden();
      closeButton.parents('.messagebox').remove();
    });

    content.html(message);
    footer.append(closeButton);

    messageBox.append(content);
    messageBox.append(footer);

    this.clearMessageBoxes();
    toggleOverlayHidden();
    this.showMessageBox(messageBox);
  }

  clearMessageBoxes() {
    $('body').find('.messagebox').remove();
  }

  showMessageBox(messageBox) {
    $('body').append(messageBox);
    messageBox.addClass('active');
  }



}
