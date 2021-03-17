import axios from "axios"

export const request = function(url, data, method) {
    method = (method)??'post'
    return new Promise(function (resolve, reject) {
        axios[method](url.replace('/administrator', ''), data).then(function(resp) {
            resolve({ok:true,resp:resp.data})            
        }).catch(function(ex) {
            resolve({ok:false,resp:e.response.data}) 
        })        
    })
}
