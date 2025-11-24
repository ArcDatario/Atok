function showToast(message, type = 'info') {
        const backgroundColor = type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : '#3498db';
        
        Toastify({
            text: message,
            duration: 5000,
            gravity: "top",
            position: "center",
            backgroundColor: backgroundColor,
            stopOnFocus: true,
            className: "toast-notification",
            style: {
                borderRadius: "8px",
                fontFamily: "'Inter', sans-serif",
                fontWeight: "500",
                padding: "12px 20px"
            }
        }).showToast();
    }