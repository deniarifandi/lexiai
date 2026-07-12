<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto">

<form
method="post"
action="<?= base_url('admin/vocabulary-exercises/update/'.$exercise['id']) ?>">

<?= csrf_field() ?>

<div class="bg-white rounded-xl border p-8 space-y-6">

<h1 class="text-2xl font-bold">

Edit Exercise

</h1>

<div>

<label class="block mb-2 font-semibold">

Question

</label>

<textarea
name="question"
rows="4"
class="w-full border rounded-lg px-4 py-3"><?= old('question',$exercise['question']) ?></textarea>

</div>

<div>

<label class="block mb-2 font-semibold">

Expected Answer

</label>

<textarea
name="expected_answer"
rows="3"
class="w-full border rounded-lg px-4 py-3"><?= old('expected_answer',$exercise['expected_answer']) ?></textarea>

</div>

<div>

<label class="block mb-2 font-semibold">

Difficulty

</label>

<select
name="difficulty"
class="w-full border rounded-lg px-4 py-3">

<option value="Easy" <?= $exercise['difficulty']=='Easy'?'selected':'' ?>>Easy</option>

<option value="Medium" <?= $exercise['difficulty']=='Medium'?'selected':'' ?>>Medium</option>

<option value="Hard" <?= $exercise['difficulty']=='Hard'?'selected':'' ?>>Hard</option>

</select>

</div>

<div class="flex justify-end gap-3">

<a
href="<?= base_url('admin/vocabularies/exercises/'.$exercise['vocabulary_id']) ?>"
class="border px-5 py-3 rounded-lg">

Cancel

</a>

<button
class="bg-zinc-950 text-white px-5 py-3 rounded-lg">

Update Exercise

</button>

</div>

</div>

</form>

</div>

<?= $this->endSection() ?>