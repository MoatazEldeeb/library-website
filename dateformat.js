const borrowEls = document.getElementsByClassName("borrow-els")
const returnEls = document.getElementsByClassName("return-els")

let borrowDate = ""
let returnDate = ""


for(let i=0;i<borrowEls.length;i++){
    borrowDate = borrowEls[i].innerText 
    returnDate = borrowEls[i].innerText 
    

    borrowDate = borrowDate.split(/(:+)/)[2]
    returnDate = returnDate.split(/(:+)/)[2]

    borrowDate = borrowDate.slice(0,5 ) + "-" + borrowDate.slice(5, 7) + "-" + borrowDate.slice(7, 9)
    returnDate = returnDate.slice(0,5 ) + "-" + returnDate.slice(5, 7) + "-" + returnDate.slice(7, 9)

    borrowEls[i].innerText = "Borrow Date: " + borrowDate
    returnEls[i].innerText = "Return Date: " + returnDate
}
