<style>
    .filter__form {
        background-color: #2c3034;
        color: #fff;
        padding: 40px;
        border: 3px solid #fff;
        border-radius: 10px;

        & h3 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 25px;
        }
    }
</style>

<form class="form-content filter__form" action="/" method="post">
    <h3 class="text-center">Custom characters</h3>
    @csrf
    <div class="">
        <label for="name" class="form-label">Name :</label>
        <input type="text" name="name" placeholder="Rick">
    </div>

    <div class="">
        <label for="episode" class="form-label">Episode id :</label>
        <input type="number" min="1" max="51" name="episode" placeholder="51">
    </div>

    <div class="">
        <label for="location" class="form-label">Location:</label>
        <input type="text" name="location" placeholder="Earth">
    </div>

    <div class="">
        <select class="form-select" name="options" aria-label="Default select example">
            <option selected disabled>Status :</option>
            <option value="alive">alive</option>
            <option value="dead">dead</option>
            <option value="unknown">unknown</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-5">Filter</button>
</form>