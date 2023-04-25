const Log = require('laravel-mix/src/Log');

window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
 
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});
 
const Pusher = require("pusher");

const pusher = new Pusher({
  appId: "1576936",
  key: "",
  secret: "",
  cluster: "mt1",
  useTLS: true
});

// // الاشتراك في قناة الرسائل
// var channel = pusher.subscribe('messages');

// // الاستماع إلى حدث الرسالة الجديدة
// channel.bind('NewMessage', function(data) {
//     console.log('User ID:', data.user_id);
//     console.log('Message Content:', data.message_content);
//     console.log('Created At:', data.created_at);
// });

 



const sendButton = document.querySelector('#BtnSend');
 

// إضافة حدث Click للزر Send
sendButton.addEventListener('click', function (event) {
  event.preventDefault(); // يمنع تحميل الصفحة عند النقر على الزر
  sendMessage();
   
});

document.getElementById("inputmessage").addEventListener("keydown", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
   sendMessage();
    
  }
});



function sendMessage (){   //  ....................................Event sendMessage............................................
  
  const messageInput = document.querySelector('#inputmessage');
  const message = messageInput.value;
  const li = document.createElement('li');
  li.classList.add('sender');
  const p = document.createElement('p');
  p.textContent = message; 
  const time = document.createElement('span'); // إضافة عنصر span لعرض الوقت
  time.classList.add('time');
  const now = new Date();
  time.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }); // تعيين الوقت الحالي

  li.appendChild(p);
  li.appendChild(time);

  const messageDate = now.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }); // إضافة رسالة جديدة إلى ul
  if (messageDate !== lastDate) {
    const dateLi = document.createElement('li');
    dateLi.classList.add('date-divider');
    dateLi.classList.add('my-class');
    const dateSpan = document.createElement('span');
    dateSpan.textContent = messageDate;
    dateLi.appendChild(dateSpan);
    ul.appendChild(dateLi);
    lastDate = messageDate;
  }

  ul.appendChild(li);
  $(document).ready(function() {
    $(".modal-body").animate({ scrollTop: $(".modal-body")[1].scrollHeight }, 500);
  });
  sendAi(message);
  // إفراغ حقل النص بعد الإرسال
  messageInput.value = '';
 
}  // .................................................................End event sendMessage...............................................................




function repalyMessageAi (message,countli){   //  ..........................Event repalyMessageAi............................................
  const existingLi = document.getElementById('li-id'+ countli); 
  if(existingLi) {
 //العنصر موجود بالفعل'
 const p = existingLi.querySelector('p');
  p.textContent = message;

} else { 
  //العنصر غير موجود


  const li = document.createElement('li');
  li.classList.add('repaly');
  li.setAttribute('id', 'li-id'+ countli);
  const p = document.createElement('p');
  p.textContent = message; 
  const time = document.createElement('span'); // إضافة عنصر span لعرض الوقت
  time.classList.add('time');
  const now = new Date();
  time.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }); // تعيين الوقت الحالي

  li.appendChild(p);
  li.appendChild(time);

  const messageDate = now.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }); // إضافة رسالة جديدة إلى ul
  if (messageDate !== lastDate) {
    const dateLi = document.createElement('li');
 
    dateLi.classList.add('date-divider');
    dateLi.classList.add('my-class');
    const dateSpan = document.createElement('span');
    dateSpan.textContent = messageDate;
    dateLi.appendChild(dateSpan);
    ul.appendChild(dateLi);
    lastDate = messageDate;
  }
  

  ul.appendChild(li);


    
  }// end if(existingLi)
  $(document).ready(function() {
    $(".modal-body").animate({ scrollTop: $(".modal-body")[1].scrollHeight }, 500);
  });
  
  // إفراغ حقل النص بعد الإرسال
  
 
}  // .................................End event repalyMessageAi...............................................................

$(document).ready(function() {
  $(".modal-body").animate({ scrollTop: $(".modal-body")[1].scrollHeight }, 1000);
});



// axios.post('api/messages', {
//     message: 'Hello world'
// })
// .then(response => {
//     console.log(response.data);
// })
// .catch(error => {
//     console.error(error);
// });

function sendAi (message){  
 
  const xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    var answer=""
    var   countli ;
  if (this.readyState == 3 && this.status == 200) {
 
    const arr =this.response.split("data: ").filter(Boolean).filter(element => !element.includes('[DONE]'));;
 
 
    const arrchoices=new Array;
 
    arr.forEach(element => {
   
      try {
        const dataObject =JSON.parse(element);
        if (dataObject.choices[0].delta.content) {
          countli=dataObject.created;
          arrchoices.push(dataObject.choices[0].delta.content) ;
          answer=answer+dataObject.choices[0].delta.content;
        }
       
      } catch (error) {
      
        arrchoices.push(error)
      }
    
  
    });

    repalyMessageAi(answer,countli);
   // console.log(answer);
  
 
  
 console.log(countli);
  }
  };
  
  xhttp.open("POST", "https://api.openai.com/v1/chat/completions", true);
  xhttp.setRequestHeader("Content-type", "application/json");
  xhttp.setRequestHeader("Authorization", "Bearer sk-");
  xhttp.send(JSON.stringify({
  "model": "gpt-3.5-turbo",
  "messages": [{"role": "user", "content": message}],
  "stream": true,
  
  }));

}
function sendAi1 (message){  

var axios = require('axios');
var data = JSON.stringify({
  "model": "gpt-3.5-turbo",
  "messages": [
    {
      "role": "user",
      "content": message
    }
  ],
   
  "stream": true
});

var config = {
  method: 'post',
  url: 'https://api.openai.com/v1/chat/completions',
  headers: { 
    'Authorization': 'Bearer sk-', 
    'Content-Type': 'application/json', 
   
  },
  data : data
};

axios(config)
.then(function (response) {
  const arr = response.data.split("data: ").filter(Boolean).filter(element => !element.includes('[DONE]'));;
 
 
  const arrchoices=new Array;
  var answer=""
  arr.forEach(element => {
  
    try {
      const dataObject =JSON.parse(element);
      if (dataObject.choices[0].delta.content) {
        arrchoices.push(dataObject.choices[0].delta.content) ;
        answer=answer+dataObject.choices[0].delta.content;
      }
     
    } catch (error) {
    
      arrchoices.push(error)
    }
  

  });
  repalyMessageAi(answer);
  console.log(answer);
})
.catch(function (error) {
  console.log(error);
});

}
