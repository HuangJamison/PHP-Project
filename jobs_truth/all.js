const title = document.querySelector('.title');
const topics = document.querySelector('.topics__all');
// const msg__all = document.querySelector('.msg__form-all');

topics.addEventListener('click',function(e){
    let form = e.target.nextElementSibling;
    if (e.target.classList.contains('msg__btn')){
        form.classList.toggle('hidden');
    }
})

topics.addEventListener('click',function(e){
    if (e.target.classList.contains("topic__edit")){
        // 先找到其父節點
        let topic = e.target.parentNode;
        var id = e.target.dataset.article_id;
        console.log(id)
        let child = topic.childNodes;
        for (let i=0; i < child.length;i++){
            if(child[i].classList.contains('topic__time')){
                var create_at = child[i].innerText;
            }else if(child[i].classList.contains('topic__company')){
                var company = child[i].innerText.substr(3);
                console.log(company)
            }else if(child[i].classList.contains('topic__author')){
                var author = child[i].innerText;
            }else if(child[i].classList.contains('topic__good')){
                var good = child[i].innerText.substr(3);
            }else if(child[i].classList.contains('topic__bad')){
                var bad = child[i].innerText.substr(3);
            }
        }
        let str = '';
        str+= `
                <div class = 'article_edit'>
                    <form method='POST' action='handle_edit_article.php'>
                        <div class='topic__author'> ${author} </div>
                        <div class='topic__time'> ${create_at} </div>
                        公司:<div class='topic__company'><input type='text' name='company' value=${company}> </div>
                        優點:<div class='topic__good'><input type='text' name='good' value=${good}></div>
                        缺點:<div class='topic__bad'><input type='text' name='bad' value=${bad}></div>
                        <input type='hidden' name=id value=${id}>
                        <div class='topic__submit'><input type='submit' value='送出'/></div>
                    </form>
                </div>
              `
        topic.innerHTML = str;
    }
})

// 改留言 ajax
const xhr = new XMLHttpRequest();
topics.addEventListener("click",function(e){
    if (e.target.classList.contains("msg__edit")){
        let parent = e.target.parentNode.parentNode;
        let comm_id = e.target.dataset.comm_id;
        // 1. 指定後端路由
        xhr.open("GET",`handle_comment_search.php?comm_id=${comm_id}`);
        // 2. 定義傳輸格式
        xhr.setRequestHeader("Content-type","application/json;charset=utf-8");
        xhr.send(); // 3. 送出
        xhr.onload = function(){
            const res_data = JSON.parse(xhr.responseText);
            display_comment_edit(res_data.data[0],parent);
        }
    }
})
function display_comment_edit(data,parent){
    var current_time = new Date();
    var time = `${current_time.getFullYear()}-${current_time.getMonth()+1}-${current_time.getDate()} ${current_time.getHours()}:${current_time.getMinutes()}`;
    console.log(time)
    console.log(data)
    let str = ''
    str += `<form method="POST" action="handle_comment_edit.php">
                <input type="hidden" name="create_at" value="${time}">
                <input type="hidden" name="id" value="${data.comment_id}">
                <div class="msg__form-info">
                    <div class="msg__form-author"> ${data.comment_username} </div>
                    <div class="msg__form-time"> ${time} </div>
                </div>
                <div class="msg__form-content">
                    <textarea row="5" cols="50" name="content">${data.comment_content}</textarea>
                </div>
                <div class="msg__form-submit">
                    <input type="submit" value="送出">
                </div>
            </form>
           `
    parent.innerHTML = str;
}