const fs = require('fs');
const html = fs.readFileSync('C:/Users/user/.gemini/antigravity/brain/51c4f424-76bf-439c-a86e-2f87b229b029/dashboard_page.html', 'utf8');

const regex = /<input[^>]*>/gi;
let match;
while ((match = regex.exec(html)) !== null) {
    console.log(match[0].slice(0, 200));
}
