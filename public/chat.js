document.addEventListener('DOMContentLoaded', () => {
    const chatbox = document.getElementById('chatbox');
    const openChat = document.getElementById('openChat');
    const closeChat = document.getElementById('closeChat');
    const collapseChat = document.getElementById('collapseChat');
    const chatInput = document.getElementById('chatInput');
    const sendChat = document.getElementById('sendChat');
    const chatMessages = document.getElementById('chatMessages');

    let isCollapsed = false;

    // Open Chatbox
    openChat?.addEventListener('click', () => {
        chatbox?.classList.remove('hidden');
        openChat?.classList.add('hidden');
    });

    // Close Chatbox
    closeChat?.addEventListener('click', () => {
        chatbox?.classList.add('hidden');
        openChat?.classList.remove('hidden');
    });

    // Collapse Chatbox
    collapseChat?.addEventListener('click', () => {
        if (!isCollapsed) {
            chatMessages?.classList.add('hidden');
            chatInput?.parentElement?.classList.add('hidden');
            collapseChat.innerHTML = '&#x25B2;'; // Up arrow
        } else {
            chatMessages?.classList.remove('hidden');
            chatInput?.parentElement?.classList.remove('hidden');
            collapseChat.innerHTML = '&#x25BC;'; // Down arrow
        }
        isCollapsed = !isCollapsed;
    });

    // Send Chat Message
    sendChat?.addEventListener('click', () => {
        const message = chatInput?.value.trim();

        if (message) {
            const newMessage = document.createElement('div');
            newMessage.classList.add('text-right', 'mb-4');
            newMessage.innerHTML = `
                <div class="bg-orange-500 text-white inline-block p-3 rounded-lg">
                    ${message}
                </div>
                <p class="text-xs text-gray-400 mt-1">You - ${new Date().toLocaleTimeString()}</p>
            `;
            chatMessages?.appendChild(newMessage);
            chatInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    });
});
