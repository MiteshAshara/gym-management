<style>
    .main-footer {
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        padding: 1.2rem 0;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.02);
    }
    
    .footer-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    
    .footer-brand {
        display: flex;
        align-items: center;
    }
    
    .footer-logo {
        height: 36px;
        margin-right: 0.8rem;
    }
    
    .footer-brand-text h6 {
        margin-bottom: 0;
        font-weight: 600;
        color: #333;
    }
    
    .footer-brand-text p {
        margin-bottom: 0;
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .footer-links {
        display: flex;
        gap: 1.5rem;
    }
    
    .footer-links a {
        color: #495057;
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .footer-links a:hover {
        color: #007bff;
    }
    
    .footer-social {
        display: flex;
        gap: 0.8rem;
    }
    
    .social-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f8f9fa;
        color: #6c757d;
        transition: all 0.3s;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .social-icon:hover {
        transform: translateY(-3px);
        color: #fff;
    }
    
    .social-icon.facebook:hover {
        background-color: #1877F2;
        border-color: #1877F2;
    }
    
    .social-icon.instagram:hover {
        background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
        border-color: #C13584;
    }
    
    .social-icon.twitter:hover {
        background-color: #1DA1F2;
        border-color: #1DA1F2;
    }
    
    .social-icon.youtube:hover {
        background-color: #FF0000;
        border-color: #FF0000;
    }
    
    .copyright {
        text-align: center;
        font-size: 0.8rem;
        color: #6c757d;
        width: 100%;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            gap: 1rem;
        }
        
        .footer-links {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .footer-social {
            justify-content: center;
        }
    }
    
    /* Chatbot Styles */
    .chat-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }
    
    .chat-button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        transition: all 0.3s;
        border: none;
    }
    
    .chat-button:hover {
        transform: scale(1.1);
    }
    
    .chat-button i {
        font-size: 24px;
        transition: transform 0.3s;
    }
    
    .chat-button.open i {
        transform: rotate(180deg);
    }
    
    .chat-container {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        display: none;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.3s;
        z-index: 999;
        max-height: 500px;
    }
    
    .chat-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .chat-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .chat-body {
        padding: 15px;
        overflow-y: auto;
        flex-grow: 1;
        max-height: 350px;
    }
    
    .chat-message {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }
    
    .user-message {
        align-items: flex-end;
    }
    
    .bot-message {
        align-items: flex-start;
    }
    
    .message-content {
        padding: 10px 15px;
        border-radius: 18px;
        font-size: 0.9rem;
        max-width: 80%;
    }
    
    .user-message .message-content {
        background-color: #007bff;
        color: white;
        border-bottom-right-radius: 4px;
    }
    
    .bot-message .message-content {
        background-color: #f1f3f5;
        color: #333;
        border-bottom-left-radius: 4px;
    }
    
    .chat-footer {
        padding: 10px;
        border-top: 1px solid #f1f3f5;
        display: flex;
    }
    
    .chat-input {
        flex-grow: 1;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 8px 15px;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s;
    }
    
    .chat-input:focus {
        border-color: #007bff;
    }
    
    .chat-send {
        width: 40px;
        height: 40px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        margin-left: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
    }
    
    .chat-send:hover {
        background-color: #0056b3;
    }
    
    .suggestions {
        display: flex;
        flex-wrap: wrap;
        margin-top: 10px;
        gap: 8px;
    }
    
    .suggestion {
        background-color: #e9f2ff;
        color: #007bff;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        cursor: pointer;
        border: 1px solid #c9e2ff;
        transition: all 0.2s;
    }
    
    .suggestion:hover {
        background-color: #007bff;
        color: white;
    }
    
    .chat-notification {
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    @media (max-width: 576px) {
        .chat-container {
            width: calc(100% - 40px);
            bottom: 80px;
        }
    }
</style>

<footer class="main-footer">
    <div class="container-fluid">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-brand-text">
                    <h6>Fitness Gym Center</h6>
                    <p>Strength & Wellness</p>
                </div>
            </div>
            
            <div class="footer-links">
                <a href="{{ route('member') }}">Members</a>
                <a href="{{ route('inquiries') }}">Inquiries</a>
                <a href="{{ route('reneable') }}">Renewals</a>
                <a href="{{ route('admin.dashboard') }}">Help & Support</a>
            </div>
            
            <div class="footer-social">
                <a href="https://www.facebook.com/profile.php?id=61559284978943" class="social-icon facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/techsinfoway/" class="social-icon instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        
        <div class="copyright">
            &copy; {{ date('Y') }} Fitness Gym Center. All Rights Reserved.<br>Managed By <a href="https://www.facebook.com/profile.php?id=61559284978943" style="text-decoration: none;font-weight:bold;" class="text-dark">Techsinfoway</a>
        </div>
    </div>
</footer>

<!-- Chatbot Widget -->
<!-- <div class="chat-widget">
    <button class="chat-button" id="chatToggle">
        <i class="fas fa-comment-dots"></i>
        <span class="chat-notification">1</span>
    </button>
</div>

<div class="chat-container" id="chatContainer">
    <div class="chat-header">
        <h5><i class="fas fa-robot mr-2"></i> Gym Helper</h5>
        <button class="btn btn-sm text-white" id="closeChat">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="chat-body" id="chatBody">
        <div class="chat-message bot-message">
            <div class="message-content">
                👋 Hi there! I'm your gym management assistant. How can I help you today?
            </div>
        </div>
        <div class="suggestions">
            <div class="suggestion">How to add a member?</div>
            <div class="suggestion">Renewal process</div>
            <div class="suggestion">Managing inquiries</div>
            <div class="suggestion">Fee management</div>
        </div>
    </div>
    <div class="chat-footer">
        <input type="text" class="chat-input" id="chatInput" placeholder="Type your question here..." autocomplete="off">
        <button class="chat-send" id="sendMessage">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</div> -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatToggle = document.getElementById('chatToggle');
        const chatContainer = document.getElementById('chatContainer');
        const closeChat = document.getElementById('closeChat');
        const chatBody = document.getElementById('chatBody');
        const chatInput = document.getElementById('chatInput');
        const sendMessage = document.getElementById('sendMessage');
        const chatNotification = document.querySelector('.chat-notification');
        
        // Open/Close chat
        chatToggle.addEventListener('click', function() {
            chatContainer.style.display = chatContainer.style.display === 'flex' ? 'none' : 'flex';
            this.classList.toggle('open');
            chatNotification.style.display = 'none';
            chatInput.focus();
        });
        
        closeChat.addEventListener('click', function() {
            chatContainer.style.display = 'none';
            chatToggle.classList.remove('open');
        });
        
        // Handle message sending
        const sendUserMessage = () => {
            const message = chatInput.value.trim();
            if (message) {
                addMessage(message, 'user');
                chatInput.value = '';
                
                // Simulate "typing" indicator
                setTimeout(() => {
                    handleResponse(message);
                }, 800);
            }
        };
        
        sendMessage.addEventListener('click', sendUserMessage);
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendUserMessage();
            }
        });
        
        // Click event for suggestions
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('suggestion')) {
                addMessage(e.target.textContent, 'user');
                handleResponse(e.target.textContent);
            }
        });
        
        // Add messages to chat
        function addMessage(message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message');
            
            if (type === 'user') {
                messageDiv.classList.add('user-message');
                messageDiv.innerHTML = `<div class="message-content">${message}</div>`;
            } else {
                messageDiv.classList.add('bot-message');
                messageDiv.innerHTML = `<div class="message-content">${message}</div>`;
            }
            
            chatBody.appendChild(messageDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
        
        // Response logic based on input
        function handleResponse(message) {
            const lowercaseMsg = message.toLowerCase();
            let response = '';
            let suggestions = [];
            
            if (lowercaseMsg.includes('add') && lowercaseMsg.includes('member')) {
                response = `To add a new member:<br>
                    1. Go to Members menu<br>
                    2. Click on "Add New Member"<br>
                    3. Fill out the form with member details<br>
                    4. Upload a photo (optional)<br>
                    5. Select membership duration and category<br>
                    6. Click Save`;
                suggestions = ['Edit a member', 'Delete a member', 'View all members'];
            } 
            else if (lowercaseMsg.includes('renewal') || lowercaseMsg.includes('renew')) {
                response = `For membership renewals:<br>
                    1. Go to Renewals menu<br>
                    2. You'll see members approaching expiry date<br>
                    3. Click on "Renew" button next to a member<br>
                    4. Set the new membership end date<br>
                    5. Process the payment`;
                suggestions = ['Upcoming renewals', 'Renewal reports', 'Expired memberships'];
            }
            else if (lowercaseMsg.includes('inquir')) {
                response = `Managing inquiries:<br>
                    1. Go to Inquiries section<br>
                    2. View all hot, cold, and pending inquiries<br>
                    3. Add new inquiry with "Add Inquiry" button<br>
                    4. Update status to track conversion rate<br>
                    5. Convert inquiries directly to members when ready`;
                suggestions = ['Hot inquiries', 'Inquiry conversion', 'Add new inquiry'];
            }
            else if (lowercaseMsg.includes('fee')) {
                response = `For fee management:<br>
                    1. Navigate to Fee Management<br>
                    2. Select the category (Student, Staff, etc.)<br>
                    3. View existing fee structures<br>
                    4. Add or edit fees for different durations<br>
                    5. Changes will apply to new member registrations`;
                suggestions = ['Student fees', 'Staff fees', 'Fee reports'];
            }
            else {
                response = `I'm not sure I understand that question. Can I help you with any of these topics?`;
                suggestions = ['Add/edit members', 'Process renewals', 'Manage inquiries', 'Fee management', 'Reports'];
            }
            
            addMessage(response, 'bot');
            
            // Add suggestions if available
            if (suggestions.length > 0) {
                const suggDiv = document.createElement('div');
                suggDiv.classList.add('suggestions');
                let suggHtml = '';
                suggestions.forEach(sugg => {
                    suggHtml += `<div class="suggestion">${sugg}</div>`;
                });
                suggDiv.innerHTML = suggHtml;
                chatBody.appendChild(suggDiv);
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        }
        
        // Auto-show chat widget after 15 seconds with a welcome message
        setTimeout(() => {
            if (chatContainer.style.display !== 'flex') {
                chatNotification.style.display = 'flex';
            }
        }, 15000);
    });
</script>