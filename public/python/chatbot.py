from fastapi import FastAPI, HTTPException

app = FastAPI()

import langchain
import os
import openai
from langchain.embeddings import OpenAIEmbeddings
from langchain.vectorstores import Chroma
from langchain import OpenAI, VectorDBQA
from langchain.document_loaders import UnstructuredFileLoader
from langchain.text_splitter import CharacterTextSplitter
import nltk

nltk.download("punkt")

os.environ["OPENAI_API_KEY"] = "Put your key here"

# Assuming your file is in the 'PdfTest' folder
file_path = "Put your file path here"

loader = UnstructuredFileLoader(file_path)
documents = loader.load()

# If you want to load the file as a list of elements
loader = UnstructuredFileLoader(file_path, mode='elements')

text_splitter = CharacterTextSplitter(chunk_size=1000, chunk_overlap=0)
texts = text_splitter.split_documents(documents)

embeddings = OpenAIEmbeddings(openai_api_key=os.environ['OPENAI_API_KEY'])
doc_search = Chroma.from_documents(texts, embeddings)
chain = VectorDBQA.from_chain_type(llm=OpenAI(), chain_type="stuff", vectorstore=doc_search)


@app.get("/query/chat-bot/{my_key}/{query}")
async def read_item(my_key: str, query: str):
    if my_key != "MyData":
        raise HTTPException(status_code=400, detail="Invalid key")

    result = chain.run(query)
    return {"query": query, "result": result}

if __name__ == "__main__":
    import uvicorn

    uvicorn.run(app, host="31.220.75.161", port=3301)
