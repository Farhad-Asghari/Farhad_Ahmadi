def binary_search(arr, target):
    
    left, right = 0, len(arr) - 1
    
    while left <= right:
        mid = (left + right) // 2
        
        if arr[mid] == target:
            return mid
        elif arr[mid] < target:
            left = mid + 1
        else:
            right = mid - 1
    
    return -1
    
sorted_numbers = [1, 3, 5, 7, 9, 11, 13, 15, 17, 19]
target = 11

result = binary_search(sorted_numbers, target)

if result != -1:
    print(f"عدد {target} در اندیس {result} پیدا شد")
else:
    print(f"عدد {target} در لیست وجود ندارد")
