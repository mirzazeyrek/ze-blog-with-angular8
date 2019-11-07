export interface Post {
  id: number;
  title: string;
  text: string;
}

export interface PostResponse {
  post: Post;
}

export interface PostListResponse {
  posts: Post[];
}
