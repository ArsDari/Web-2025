function renderPost()
{
    const posts = document.querySelector('#posts');
    const postBlock = document.createElement('div');
    postBlock.classList.add('post');

    const postTitle = document.createElement('h2');
    postBlock.appendChild(postTitle);

    const postDescription = document.createElement('p');
    postDescription.textContent = post.body;
    postBlock.appendChild(postDescription);

    posts.appendChild(postBlock);
}

function initGetPosts()
{
    fetch('https://dummyjson.com/posts?limit=5')
    .then(res => res.json())
    .then(res => {
        res.posts.forEach(post => {
            console.log(post.title);
            const postBlock = document.createElement('div');
            postBlock. textTexture()
        });
        console.log(posts)
    });
}

async function addPost(params)
{
    const res = await fetch('https://dummyjson.com/posts/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: 'Test',
            body: 'test description',
            userId: 1,
        })
    })
    const post = await res.json();

    renderPost()
}

function initAddPost()
{
    const addPostButton = document.querySelector('#addPostButton');
    addPostButton.addEventListener('click', () => {
        const title = document.querySelector('#postTitle');
        const description = document.querySelector('#postDescrpition');
        title.value;

        addPost();
    });
}

getPosts();
initAddPost();